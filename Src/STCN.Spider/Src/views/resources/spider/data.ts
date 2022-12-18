import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';

export const columns: BasicColumn[] = [
  {
    title: '标题',
    dataIndex: 'sourceTitle',
    align: 'left',
  },
  {
    title: '作者',
    dataIndex: 'sourceAuthor',
    width: 100,
  },
  {
    title: '发布时间',
    dataIndex: 'sourcePubTime',
    width: 180,
  },
  {
    title: '原文',
    dataIndex: 'sourceUrl',
    key: 'url',
    slots: { customRender: 'url' },
    align: 'left',
  },
  {
    title: '来源',
    dataIndex: 'sourceName',
    width: 100,
  },
  {
    title: '发布源',
    dataIndex: 'pubSourceName',
    width: 100,
  },
  {
    title: '媒体',
    dataIndex: 'pubMediaName',
    width: 80,
  },
  {
    title: '子媒',
    dataIndex: 'pubProductName',
    width: 100,
  },
  {
    title: '平台',
    dataIndex: 'pubPlatformName',
    width: 80,
  },
  {
    title: '频道',
    dataIndex: 'pubChannelName',
    width: 80,
  },
  // {
  //   title: '内容',
  //   dataIndex: 'sourceContent',
  // },
];

export const searchFormSchema: FormSchema[] = [
  {
    field: 'keyword',
    label: '关键词',
    component: 'Input',
    colProps: { span: 8 },
  },
];
