import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';

export const columns: BasicColumn[] = [
  {
    title: '来源',
    dataIndex: 'source',
    width: 160,
  },
  {
    title: '标题',
    dataIndex: 'title',
    align: 'left',
  },
  {
    title: '作者',
    dataIndex: 'author',
    width: 120,
  },
  {
    title: '编辑',
    dataIndex: 'editor',
    width: 120,
  },
  {
    title: '类别',
    dataIndex: 'newsType',
    width: 120,
  },
  {
    title: '发布时间',
    dataIndex: 'publishTime',
    width: 180,
  },
  {
    title: '原文',
    dataIndex: 'url',
    key: 'url',
    slots: { customRender: 'url' },
  },
  // {
  //   title: '内容',
  //   dataIndex: 'content',
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
