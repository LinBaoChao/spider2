import { h, Slots } from 'vue';
import { Tag } from 'ant-design-vue';
import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';

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
    dataIndex: 'name',
    width: 160,
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
    width: 100,
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
      const enable = record.isWriteDb;
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
    title: '过滤',
    dataIndex: 'filter',
    width: 200,
  },
  {
    title: '过滤类型',
    dataIndex: 'filterType',
    width: 100,
  },
  {
    title: '数据源类型',
    dataIndex: 'sourceType',
    width: 100,
  },
  {
    title: '合并字段',
    dataIndex: 'joinField',
  },
  {
    title: '合并分割符',
    dataIndex: 'joinFieldSplit',
  },
  {
    title: '新Url',
    dataIndex: 'attachedUrl',
  },
  {
    title: '创建时间',
    dataIndex: 'createTime',
    width: 160,
  },
];

export const formSchema: FormSchema[] = [
  {
    field: 'name',
    label: '字段',
    component: 'Input',
    helpMessage: [
      '不能重复，英文',
      '与写入数据库表的字段要对应，如source_title,source_content,source_author,source_pub_time,source_name,source_channel_name',
    ],
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
    helpMessage: ['多个用【分割', "默认使用xpath,如//div[contains(@class,'content')]"],
    // rules: [
    //   {
    //     //required: true,
    //     //message: '请输入抽取规则',
    //   },
    // ],
  },
  {
    field: 'selectorType',
    label: '抽取规则类型',
    component: 'Input',
    defaultValue: 'xpath',
    helpMessage: [
      '多个用【分割，顺序与抽取规则对应',
      '默认xpath，目前可用有xpath, css, regex, jsonpath, self',
    ],
  },
  // {
  //   field: 'selectorType',
  //   label: '抽取规则类型',
  //   component: 'Select',
  //   componentProps: {
  //     options: [
  //       { label: 'xpath', value: 'xpath' },
  //       { label: 'css', value: 'css' },
  //       { label: 'regex', value: 'regex' },
  //       { label: 'self', value: 'self' }, // selector的原内容
  //     ],
  //     mode: 'multiple',
  //   },
  //   defaultValue: 'xpath',
  //   helpMessage: ['可多选，顺序与抽取规则对应', '默认xpath，目前可用有xpath, css, regex, self'],
  //   // rules: [
  //   //   {
  //   //     //required: true,
  //   //     //message: '请输入抽取规则的类型',
  //   //   },
  //   // ],
  // },
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
    //required: true,
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
    //required: true,
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
    label: '过滤',
    component: 'InputTextArea',
    helpMessage: ['多个用【分割', '输入符合过滤类型的过滤规则或过滤内容，并选择对应的过滤类型'],
  },
  {
    field: 'filterType',
    label: '过滤类型',
    component: 'Input',
    helpMessage: [
      '多个用【分割，顺序要和过滤项相对应',
      '目前可用有replace, xpath, regex, css, self(过滤项本身), strip_tags(过滤项保留多个标签时用,分割), substr(过滤项设置为0,3的形式,当不限制长度时可设为空或0), trim(过滤项设置：空或|no|则无参数，|space|则为空格), explode参数设置为(分割符`,`第几个)',
    ],
  },
  // {
  //   field: 'filterType',
  //   label: '过滤类型',
  //   component: 'Select',
  //   componentProps: {
  //     options: [
  //       { label: 'replace', value: 'replace' },
  //       { label: 'regex', value: 'regex' },
  //       { label: 'xpath', value: 'xpath' },
  //       { label: 'css', value: 'css' },
  //       { label: 'self', value: 'self' },
  //     ],
  //     mode: 'multiple',
  //   },
  //   helpMessage: ['可多选', '顺序要和过滤项相对应，目前可用有xpath, css,regex,self'],
  // },
  {
    field: 'joinField',
    label: '合并字段',
    component: 'Input',
    helpMessage: ['合并字段', '用什么符号分割就用什么符号连接内容'],
  },
  {
    field: 'joinFieldSplit',
    label: '合并分割符',
    component: 'Input',
    helpMessage: ['合并字段分割符', '如果值直接连接不用分割则是|no|,空格则用|space|,或则用|or|'],
  },
  {
    field: 'parentId',
    label: '父字段',
    component: 'TreeSelect',
    componentProps: {
      replaceFields: {
        title: 'name',
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
];
