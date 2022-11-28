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
      <template #toolbar> </template>
      <template #action="{ record }">
        <TableAction
          :actions="[
            // {
            //   icon: 'clarity:info-standard-line',
            //   tooltip: '查看详情',
            //   onClick: handleDetail.bind(null, record),
            //   auth: 'Resources.Spider.View',
            // },
            {
              icon: 'ant-design:delete-outlined',
              color: 'error',
              tooltip: '删除',
              popConfirm: {
                title: '是否确认删除',
                confirm: handleDelete.bind(null, record),
              },
              auth: 'Resources.Spider.Delete',
            },
          ]"
        />
      </template>
      <template #url="{ text }">
        <a :href="text" target="_blank">{{ text }}</a>
      </template>
    </BasicTable>
    <!-- <Detail @register="registerDetail" /> -->
  </PageWrapper>
</template>
<script lang="ts">
  import { defineComponent, reactive, nextTick, ref } from 'vue';
  import { BasicTable, useTable, TableAction } from '/@/components/Table';
  import { PageWrapper } from '/@/components/Page';
  // import { useModal } from '/@/components/Modal';
  // import { useGo } from '/@/hooks/web/usePage';
  // import { useDrawer } from '/@/components/Drawer';
  import { useMessage } from '/@/hooks/web/useMessage';
  import { usePermission } from '/@/hooks/web/usePermission';
  // import { Authority } from '/@/components/Authority';

  // import Detail from './detail.vue';
  //import DetailModal from './detail.vue';
  import { openWindow } from '/@/utils';
  import { columns, searchFormSchema } from './data';
  import { spiderList, spiderDelete } from '/@/api/spider';

  export default defineComponent({
    name: 'SpiderNews',
    components: { BasicTable, PageWrapper, TableAction },
    setup() {
      // const [registerDetail, { openDrawer: openDetail }] = useDrawer();
      // const go = useGo();
      // const [registerModal, { openModal }] = useModal();
      const searchInfo = reactive<Recordable>({});
      const loadingRef = ref(false);
      const { notification } = useMessage();
      const { hasPermission } = usePermission();
      const [registerTable, { reload, updateTableDataRecord }] = useTable({
        title: '新闻列表',
        api: spiderList,
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

      function openPage(url) {
        openWindow(url);
      }

      function handleDelete(record: Recordable) {
        nextTick(async () => {
          try {
            loadingRef.value = true;
            await spiderDelete(record.id);
            loadingRef.value = false;
            notification.success({
              message: `删除${record.title}成功.`,
            });
            reload();
          } catch (err) {
            loadingRef.value = false;
          }
        });
      }

      // function handleView(record: Recordable) {
      //   go('/sys/user_detail/' + record.id);
      // }

      // function handleDetail(record: Recordable) {
      //   nextTick(() => {
      //     openDetail(true, record);
      //   });
      // }

      return {
        registerTable,
        handleDelete,
        hasPermission,
        openPage,
        searchInfo,
      };
    },
  });
</script>
