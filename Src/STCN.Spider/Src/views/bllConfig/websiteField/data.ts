import { h, Slots } from 'vue';
import { Tag } from 'ant-design-vue';
import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';
import { left } from 'inquirer/lib/utils/readline';

export const searchSchema: FormSchema[] = [
  {
    field: 'keyword',
    label: '关键词',
    component: 'Input',
    colProps: { span: 8 },
  },
  {
    field: 'status',
    label: '状态',
    component: 'Select',
    componentProps: {
      options: [
        { label: '正常', value: 1 },
        { label: '停用', value: 0 },
        { label: '出错', value: 2 },
      ],
    },
    colProps: { span: 8 },
  },
];

export const columns: BasicColumn[] = [
  {
    title: '状态',
    dataIndex: 'status',
    width: 80,
    customRender: ({ record }) => {
      const enable = record.status;
      const color = enable == 1 ? 'green' : 'red';
      const text = enable == 1 ? '正常' : enable == 0 ? '停用' : '出错';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '字段',
    dataIndex: 'fieldName',
    width: 120,
  },
  {
    title: '抽取规则',
    dataIndex: 'selector',
    width: 300,
    align: 'left',
  },
  {
    title: '规则类型',
    dataIndex: 'selectorType',
    width: 80,
  },
  {
    title: '是否必须',
    dataIndex: 'required',
    width: 80,
    customRender: ({ record }) => {
      const enable = record.required;
      const color = enable == 1 ? 'green' : 'red';
      const text = enable == 1 ? '是' : '否';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '是否入库',
    dataIndex: 'isWriteDb',
    width: 80,
    customRender: ({ record }) => {
      const enable = record.repeated;
      const color = enable == 1 ? 'green' : 'red';
      const text = enable == 1 ? '是' : '否';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '是否多项',
    dataIndex: 'repeated',
    width: 80,
    customRender: ({ record }) => {
      const enable = record.repeated;
      const color = enable == 1 ? 'green' : 'red';
      const text = enable == 1 ? '是' : '否';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '过滤去除',
    dataIndex: 'filter',
    //width: 200,
    align: 'left',
  },
  {
    title: '数据源类型',
    dataIndex: 'sourceType',
    width: 100,
  },
  {
    title: '新Url',
    dataIndex: 'attachedUrl',
  },
  {
    title: '合并字段',
    dataIndex: 'joinField',
  },
  {
    title: '创建时间',
    dataIndex: 'createTime',
    width: 160,
  },
];

export const formSchema: FormSchema[] = [
  {
    field: 'fieldName',
    label: '字段',
    component: 'Input',
    helpMessage: ['不能重复，英文', '与写入数据库表的字段对应，如title,source...'],
    rules: [
      {
        required: true,
        message: '请输入名称',
      },
    ],
  },
  {
    field: 'selector',
    label: '抽取规则',
    component: 'InputTextArea',
    helpMessage: ['定义抽取规则', '默认使用xpath,如selector => //*[@id=single-next-link]'],
    rules: [
      {
        required: true,
        message: '请输入抽取规则',
      },
    ],
  },
  {
    field: 'selectorType',
    label: '抽取规则类型',
    component: 'Select',
    componentProps: {
      options: [
        { label: 'xpath', value: 'xpath', default: true },
        { label: 'jsonpath', value: 'jsonpath' },
        { label: 'regex', value: 'regex' },
        { label: 'self', value: 'self' }, // selector的原内容
      ],
    },
    defaultValue: 'xpath',
    helpMessage: ['抽取规则的类型', '默认xpath，目前可用xpath, jsonpath, regex'],
    rules: [
      {
        required: true,
        message: '请输入抽取规则的类型',
      },
    ],
  },
  {
    field: 'required',
    label: '是否必须',
    component: 'RadioButtonGroup',
    required: true,
    componentProps: {
      options: [
        { label: '是', value: 1 },
        { label: '否', value: 0 },
      ],
    },
    defaultValue: 1,
    colProps: { span: 12 },
  },
  {
    field: 'isWriteDb',
    label: '是否入库',
    component: 'RadioButtonGroup',
    required: true,
    componentProps: {
      options: [
        { label: '是', value: 1 },
        { label: '否', value: 0 },
      ],
    },
    defaultValue: 1,
    colProps: { span: 12 },
  },
  {
    field: 'repeated',
    label: '是否多项',
    component: 'RadioButtonGroup',
    required: true,
    componentProps: {
      options: [
        { label: '是', value: 1 },
        { label: '否', value: 0 },
      ],
    },
    defaultValue: 0,
    colProps: { span: 12 },
  },
  {
    field: 'status',
    label: '状态',
    component: 'RadioButtonGroup',
    componentProps: {
      options: [
        { label: '启用', value: 1 },
        { label: '禁用', value: 0 },
      ],
    },
    defaultValue: 1,
    colProps: { span: 12 },
  },
  {
    field: 'filter',
    label: '过滤移除',
    component: 'InputTextArea',
    helpMessage: ['可正则表达式'],
  },
  {
    field: 'parentId',
    label: '父字段',
    component: 'TreeSelect',
    componentProps: {
      replaceFields: {
        title: 'fieldName',
        key: 'id',
        value: 'id',
      },
      getPopupContainer: () => document.body,
    },
  },
  {
    field: 'sourceType',
    label: '数据源类型',
    component: 'Select',
    componentProps: {
      options: [
        { label: 'url_context', value: 'url_context', default: true },
        { label: 'attached_url', value: 'attached_url' },
      ],
    },
    helpMessage: [
      '默认从当前的网页中抽取数据',
      '选择attached_url可以发起一个新的请求, 然后从请求返回的数据中抽取,选择url_context可以从当前网页的url附加数据',
    ],
  },
  {
    field: 'attachedUrl',
    label: '新Url',
    component: 'Input',
    helpMessage: ['定义新请求的url', '当source_type设置为attached_url时'],
  },
  {
    field: 'joinField',
    label: '合并字段',
    component: 'Input',
    helpMessage: ['合并字段', ',用什么符号分割就用什么符号连接内容'],
  },
];
