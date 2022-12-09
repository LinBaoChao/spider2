<template>
  <PageWrapper
    dense
    contentFullHeight
    fixedHeight
    contentClass="flex"
    v-loading="loadingRef"
    loading-tip="加载中..."
  >
    <BasicTable @register="registerTable" :searchInfo="searchInfo">
      <template #toolbar>
        <a-button
          type="primary"
          @click="handleCreate"
          v-if="hasPermission('BllConfig.Website.Create')"
          >新增</a-button
        >
      </template>
      <template #action="{ record }">
        <TableAction
          :actions="[
            // {
            //   icon: 'clarity:info-standard-line',
            //   tooltip: '查看用户详情',
            //   onClick: handleDetail.bind(null, record),
            //   auth: 'BllConfig.Website.Detail.View',
            // },
            {
              icon: 'clarity:note-edit-line',
              tooltip: '修改',
              onClick: handleEdit.bind(null, record),
              auth: 'BllConfig.Website.Update',
            },
            {
              icon: 'ant-design:delete-outlined',
              color: 'error',
              tooltip: '删除',
              popConfirm: {
                title: '是否确认删除',
                confirm: handleDelete.bind(null, record),
              },
              auth: 'BllConfig.Website.Delete',
            },
            {
              icon: 'mdi:pencil-ruler-outline',
              tooltip: '规则管理',
              onClick: handleFieldConfig.bind(null, record),
              auth: 'BllConfig.Website.FieldConfig',
            },
          ]"
        />
      </template>
    </BasicTable>
    <WebsiteModal @register="registerModal" @success="handleSuccess" />
    <Detail @register="registerDetail" />
  </PageWrapper>
</template>
<script lang="ts">
  import { defineComponent, reactive, nextTick, ref } from 'vue';
  import { BasicTable, useTable, TableAction } from '/@/components/Table';
  import { PageWrapper } from '/@/components/Page';
  import { useDrawer } from '/@/components/Drawer';
  import { useGo } from '/@/hooks/web/usePage';
  import { useModal } from '/@/components/Modal';
  import { useMessage } from '/@/hooks/web/useMessage';
  import { usePermission } from '/@/hooks/web/usePermission';

  import { columns, searchFormSchema } from './data';
  import { websiteGetListByPage, websiteDeleted } from '/@/api/website';
  import WebsiteModal from './WebsiteModal.vue';
  import Detail from './detail.vue';

  export default defineComponent({
    name: 'WebsiteManagement',
    components: { BasicTable, PageWrapper, WebsiteModal, TableAction, Detail },
    setup() {
      const [registerDetail, { openDrawer: openDetail }] = useDrawer();
      const go = useGo();
      const [registerModal, { openModal }] = useModal();
      const searchInfo = reactive<Recordable>({});
      const loadingRef = ref(false);
      const { notification } = useMessage();
      const { hasPermission } = usePermission();
      const [registerTable, { reload, updateTableDataRecord }] = useTable({
        title: '网站列表',
        api: websiteGetListByPage,
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
          return info;
        },
        actionColumn: {
          width: 160,
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
            await websiteDeleted(record.id);
            loadingRef.value = false;
            notification.success({
              message: `删除${record.mediaName}成功.`,
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
              loadingRef.value = false;
              updateTableDataRecord(values.id, values);
              notification.success({
                message: `更新${values.mediaName}成功.`,
              });
            } else {
              loadingRef.value = false;
              notification.success({
                message: `新增${values.mediaName}成功.`,
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

      function handleFieldConfig(record: Recordable) {
        go('/websitefield/index/' + record.id);
      }

      function handleView(record: Recordable) {
        go('/website/detail/' + record.id);
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
        handleView,
        handleDetail,
        handleFieldConfig,
        searchInfo,
        loadingRef,
        notification,
        hasPermission,
      };
    },
  });
</script>
