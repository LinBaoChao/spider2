<template>
  <PageWrapper
    dense
    contentFullHeight
    fixedHeight
    contentClass="flex"
    v-loading="loadingRef"
    loading-tip="加载中..."
  >
    <DeptTree class="w-1/4 xl:w-1/5" @select="handleSelect" />
    <BasicTable @register="registerTable" class="w-3/4 xl:w-4/5" :searchInfo="searchInfo">
      <template #toolbar>
        <a-button type="primary" @click="handleCreate" v-if="hasPermission('Sys.User.Create')"
          >新增用户</a-button
        >
      </template>
      <template #action="{ record }">
        <TableAction
          :actions="[
            {
              icon: 'clarity:info-standard-line',
              tooltip: '查看用户详情',
              onClick: handleDetail.bind(null, record),
              auth: 'Sys.User.UserDetail.View',
            },
            {
              icon: 'clarity:note-edit-line',
              tooltip: '修改用户资料',
              onClick: handleEdit.bind(null, record),
              auth: 'Sys.User.Update',
            },
            {
              icon: 'ant-design:delete-outlined',
              color: 'error',
              tooltip: '删除此用户',
              popConfirm: {
                title: '是否确认删除',
                confirm: handleDelete.bind(null, record),
              },
              auth: 'Sys.User.Delete',
            },
          ]"
        />
      </template>
    </BasicTable>
    <AccountModal @register="registerModal" @success="handleSuccess" />
    <Detail @register="registerDetail" />
  </PageWrapper>
</template>
<script lang="ts">
  import { defineComponent, reactive, nextTick, ref } from 'vue';

  import { BasicTable, useTable, TableAction } from '/@/components/Table';
  import { getUserList, userDeleted } from '/@/api/user';
  import { PageWrapper } from '/@/components/Page';
  import DeptTree from './DeptTree.vue';

  import { useModal } from '/@/components/Modal';
  import AccountModal from './UserModal.vue';

  import { columns, searchFormSchema } from './data';
  import { useGo } from '/@/hooks/web/usePage';

  import { useMessage } from '/@/hooks/web/useMessage';
  import Detail from './detail.vue';
  import { useDrawer } from '/@/components/Drawer';

  import { usePermission } from '/@/hooks/web/usePermission';
  // import { Authority } from '/@/components/Authority';

  export default defineComponent({
    name: 'AccountManagement',
    components: { BasicTable, PageWrapper, DeptTree, AccountModal, TableAction, Detail },
    setup() {
      const [registerDetail, { openDrawer: openDetail }] = useDrawer();
      const go = useGo();
      const [registerModal, { openModal }] = useModal();
      const searchInfo = reactive<Recordable>({});
      const loadingRef = ref(false);
      const { notification } = useMessage();
      const { hasPermission } = usePermission();
      const [registerTable, { reload, updateTableDataRecord }] = useTable({
        title: '账号列表',
        api: getUserList,
        rowKey: 'id',
        columns,
        formConfig: {
          labelWidth: 120,
          schemas: searchFormSchema,
          autoSubmitOnEnter: true,
        },
        useSearchForm: true,
        showTableSetting: true,
        bordered: true,
        handleSearchInfoFn(info) {
          console.log('handleSearchInfoFn', info);
          return info;
        },
        actionColumn: {
          width: 120,
          title: '操作',
          dataIndex: 'action',
          slots: { customRender: 'action' },
        },
      });

      function handleCreate() {
        openModal(true, {
          isUpdate: false,
        });
      }

      function handleEdit(record: Recordable) {
        console.log(record);
        openModal(true, {
          record,
          isUpdate: true,
        });
      }

      function handleDelete(record: Recordable) {
        nextTick(async () => {
          try {
            loadingRef.value = true;
            await userDeleted(record.id);
            loadingRef.value = false;
            notification.success({
              message: `删除用户${record.realName}成功.`,
            });
            reload();
          } catch (err) {
            loadingRef.value = false;
          }
        });
      }

      function handleSuccess({ isUpdate, values }) {
        // if (isUpdate) {
        //   // 演示不刷新表格直接更新内部数据。
        //   // 注意：updateTableDataRecord要求表格的rowKey属性为string并且存在于每一行的record的keys中
        //   const result = updateTableDataRecord(values.id, values);
        //   console.log(result);
        // } else {

        //   reload();
        // }

        nextTick(async () => {
          try {
            loadingRef.value = true;
            if (isUpdate) {
              //await userUpdated(values);
              loadingRef.value = false;
              updateTableDataRecord(values.id, values);
              notification.success({
                message: `更新用户${values.username}成功.`,
              });
            } else {
              // await userCreated(values);
              loadingRef.value = false;
              notification.success({
                message: `新增用户${values.username}成功.`,
              });
            }
            reload();
          } catch (err) {
            loadingRef.value = false;
            notification.error({
              message: `操作失败：${err}`,
            });
          }
        });
      }

      function handleSelect(deptId = '') {
        searchInfo.deptId = deptId;
        reload();
      }

      function handleView(record: Recordable) {
        go('/sys/user_detail/' + record.id);
      }

      function handleDetail(record: Recordable) {
        nextTick(() => {
          openDetail(true, record);
        });
      }

      return {
        registerTable,
        registerModal,
        registerDetail,
        handleCreate,
        handleEdit,
        handleDelete,
        handleSuccess,
        handleSelect,
        handleView,
        handleDetail,
        searchInfo,
        loadingRef,
        notification,
        hasPermission,
      };
    },
  });
</script>
