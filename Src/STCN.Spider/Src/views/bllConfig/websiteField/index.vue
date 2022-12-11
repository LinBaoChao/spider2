<template>
  <PageWrapper
    dense
    contentFullHeight
    fixedHeight
    contentClass="flex"
    v-loading="loadingRef"
    loading-tip="加载中..."
  >
    <BasicTable @register="registerTable" :searchInfo="searchInfo" @fetch-success="onFetchSuccess">
      <template #toolbar>
        <a-button
          type="primary"
          @click="handleCreate"
          v-if="hasPermission('BllConfig.WebsiteField.Create')"
          >新增</a-button
        >
      </template>
      <template #action="{ record }">
        <TableAction
          :actions="[
            {
              icon: 'clarity:note-edit-line',
              tooltip: '修改',
              onClick: handleEdit.bind(null, record),
              auth: 'BllConfig.WebsiteField.Update',
            },
            {
              icon: 'ant-design:delete-outlined',
              color: 'error',
              tooltip: '删除',
              popConfirm: {
                title: '是否确认删除',
                confirm: handleDelete.bind(null, record),
              },
              auth: 'BllConfig.WebsiteField.Delete',
            },
          ]"
        />
      </template>
    </BasicTable>
    <WebsiteFieldModal @register="registerModal" @success="handleSuccess" />
  </PageWrapper>
</template>
<script lang="ts">
  import { defineComponent, reactive, nextTick, ref } from 'vue';
  import { BasicTable, useTable, TableAction } from '/@/components/Table';
  import { useModal } from '/@/components/Modal';
  import { useMessage } from '/@/hooks/web/useMessage';
  import { usePermission } from '/@/hooks/web/usePermission';
  import { useRoute } from 'vue-router';

  import WebsiteFieldModal from './WebsiteFieldModal.vue';
  import { columns, searchSchema } from './data';
  import { websiteFieldGetList, websiteFieldDeleted } from '/@/api/websiteField';

  export default defineComponent({
    name: 'WebsiteFieldManagement',
    components: { BasicTable, WebsiteFieldModal, TableAction },
    setup() {
      const route = useRoute();
      const mediaName = ref(route.params?.mediaName);
      const websiteId = ref(route.params?.id);
      const [registerModal, { openModal }] = useModal();
      const searchInfo = reactive<Recordable>({});
      const loadingRef = ref(false);
      const { notification } = useMessage();
      const { hasPermission } = usePermission();
      searchInfo.websiteId = websiteId.value;

      const [registerTable, { reload, updateTableDataRecord, expandAll }] = useTable({
        title: '【' + mediaName.value + '】字段规则列表',
        api: websiteFieldGetList,
        rowKey: 'id',
        columns,
        formConfig: {
          labelWidth: 120,
          schemas: searchSchema,
          autoSubmitOnEnter: true,
        },
        isTreeTable: true,
        pagination: false,
        useSearchForm: true,
        showTableSetting: true,
        bordered: true,
        showIndexColumn: false,
        handleSearchInfoFn(info) {
          searchInfo.websiteId = websiteId.value;
          return info;
        },
        actionColumn: {
          width: 100,
          title: '操作',
          dataIndex: 'action',
          slots: { customRender: 'action' },
        },
      });

      function handleCreate() {
        openModal(true, {
          websiteId: websiteId.value,
          isUpdate: false,
        });
      }

      function handleEdit(record: Recordable) {
        console.log(record);
        openModal(true, {
          websiteId: websiteId.value,
          record,
          isUpdate: true,
        });
      }

      function handleDelete(record: Recordable) {
        nextTick(async () => {
          try {
            loadingRef.value = true;
            await websiteFieldDeleted(record.id);
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
                message: `更新${values.name}成功.`,
              });
            } else {
              loadingRef.value = false;
              notification.success({
                message: `新增${values.name}成功.`,
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

      function onFetchSuccess() {
        // 演示默认展开所有表项
        nextTick(expandAll);
      }

      return {
        registerTable,
        registerModal,
        handleCreate,
        handleEdit,
        handleDelete,
        handleSuccess,
        searchInfo,
        loadingRef,
        notification,
        hasPermission,
        onFetchSuccess,
      };
    },
  });
</script>
