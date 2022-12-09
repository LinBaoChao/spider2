import { viteImagemin } from 'vite-plugin-imagemin';
import { h, Slots } from 'vue';
import { Tag } from 'ant-design-vue';
import { DescItem } from '/@/components/Description/src/typing';
import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';
import { commonTagRender } from '/@/utils/tagUtil';
import { EnableSelectOptions, EnableRadioOptions } from '/@/utils/status';
import { formatToDate } from '/@/utils/dateUtil';
import { Rule } from '/@/components/Form';
import { usePermission } from '/@/hooks/web/usePermission';

const { hasPermission } = usePermission();

export const columns: BasicColumn[] = [
  {
    title: '媒体标识',
    dataIndex: 'name',
    width: 120,
  },
  {
    title: '媒体名称',
    dataIndex: 'mediaName',
    width: 120,
  },
  {
    title: '子媒',
    dataIndex: 'productName',
    width: 120,
  },
  {
    title: '平台',
    dataIndex: 'platform',
    width: 120,
  },
  {
    title: '栏目',
    dataIndex: 'channel',
    width: 120,
  },
  {
    title: '域名',
    dataIndex: 'domains',
    width: 120,
  },
  {
    title: '入口url',
    dataIndex: 'scanUrls',
    width: 120,
  },
  {
    title: '列表url',
    dataIndex: 'listUrls',
    width: 120,
  },
  {
    title: '内容url',
    dataIndex: 'contentUrls',
    width: 120,
  },
  {
    title: '输入编码',
    dataIndex: 'inputEncoding',
    width: 120,
  },
  {
    title: '输出编码',
    dataIndex: 'outputEncoding',
    width: 180,
  },
  {
    title: '爬取间隔（秒）',
    dataIndex: 'interval',
    width: 100,
  },
  {
    title: '爬取超时（秒）',
    dataIndex: 'timeout',
    width: 100,
  },
  {
    title: '失败重试',
    dataIndex: 'maxTry',
    width: 100,
  },
  {
    title: '爬取深度',
    dataIndex: 'maxDepth',
    width: 100,
  },
  {
    title: '最内容数',
    dataIndex: 'maxFields',
    width: 100,
  },
  {
    title: '状态',
    dataIndex: 'status',
    width: 100,
    customRender: ({ record }) => {
      const enable = record.status;
      const color = enable == 1 ? 'green' : 'red';
      const text = enable == 1 ? '正常' : enable == 0 ? '停用' : '出错';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '创建时间',
    dataIndex: 'createTime',
    width: 160,
  },
];

export const searchFormSchema: FormSchema[] = [
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

export const formSchema: FormSchema[] = [
  {
    field: 'name',
    label: '媒体标识',
    component: 'Input',
    helpMessage: ['请输入媒体标识', '英文字母，媒体标识不能重复'],
    rules: [
      {
        required: true,
        message: '请输入媒体标识',
      },
    ],
  },
  {
    field: 'mediaName',
    label: '媒体名',
    component: 'Input',
    helpMessage: ['请输入媒体名', '媒体名不能重复'],
    rules: [
      {
        required: true,
        message: '请输入媒体名',
      },
    ],
  },
  {
    field: 'productName',
    label: '子媒',
    component: 'Input',
  },
  {
    field: 'platform',
    label: '平台',
    component: 'Input',
  },
  {
    field: 'channel',
    label: '栏目',
    component: 'Input',
  },
  {
    field: 'domains',
    label: '域名',
    component: 'InputTextArea',
    required: true,
    helpMessage: [
      '多个用英文逗号分隔',
      '爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度',
    ],
  },
  {
    field: 'scanUrls',
    label: '入口urls',
    component: 'InputTextArea',
    required: true,
    helpMessage: ['多个用英文逗号分隔', '爬虫的入口链接'],
  },
  {
    field: 'listUrls',
    label: '列表urls',
    component: 'InputTextArea',
    required: true,
    helpMessage: ['多个用英文逗号分隔', '可带正则规则的列表页url'],
  },
  {
    field: 'contentUrls',
    label: '内容urls',
    component: 'InputTextArea',
    required: true,
    helpMessage: ['多个用英文逗号分隔', '可带正则规则的内容页url'],
  },
  {
    field: 'inputEncoding',
    label: '输入编码',
    component: 'Input',
  },
  {
    field: 'outputEncoding',
    label: '输出编码',
    component: 'Input',
  },
  {
    field: 'interval',
    label: '爬取间隔（秒）',
    component: 'InputNumber',
    defaultValue: 1,
  },
  {
    field: 'timeout',
    label: '爬取超时（秒）',
    component: 'InputNumber',
    defaultValue: 5,
  },
  {
    field: 'maxTry',
    label: '失败重试',
    component: 'InputNumber',
    defaultValue: 0,
    helpMessage: ['请输入', '默认值为0，即不重复爬取'],
  },
  {
    field: 'maxDepth',
    label: '爬取深度',
    component: 'InputNumber',
    defaultValue: 0,
    helpMessage: ['请输入', '默认值为0，即不限制'],
  },
  {
    field: 'maxFields',
    label: '最大内容数',
    component: 'InputNumber',
    defaultValue: 0,
    helpMessage: ['请输入', '默认值为0，即不限制'],
  },
  {
    field: 'status',
    label: '状态',
    component: 'RadioButtonGroup',
    required: true,
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
    field: 'tasknum',
    label: '任务数',
    component: 'InputNumber',
    defaultValue: 1,
  },
  {
    field: 'multiserver',
    label: '多服务器处理',
    component: 'RadioButtonGroup',
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
    field: 'saveRunningState',
    label: '保存运行状态',
    component: 'RadioButtonGroup',
    componentProps: {
      options: [
        { label: '启用', value: 1 },
        { label: '禁用', value: 0 },
      ],
    },
    defaultValue: 0,
    colProps: { span: 12 },
  },
  {
    field: 'serverid',
    label: '第几台服务器',
    component: 'InputNumber',
    defaultValue: 1,
  },
  {
    field: 'clientIp',
    label: '伪IP',
    component: 'InputTextArea',
    helpMessage: [
      '多个用英文逗号分隔',
      '爬虫爬取网页所使用的伪IP，用于破解防采集如192.168.0.2,192.168.0.3,...',
    ],
  },
  {
    field: 'userAgent',
    label: '代理',
    component: 'InputTextArea',
    helpMessage: ['随机浏览器类型', '用于破解防采集'],

    // AGENT_ANDROID, 表示爬虫爬取网页时, 使用安卓手机浏览器
    // AGENT_IOS, 表示爬虫爬取网页时, 使用苹果手机浏览器
    // AGENT_PC, 表示爬虫爬取网页时, 使用PC浏览器
    // AGENT_MOBILE, 表示爬虫爬取网页时, 使用移动设备浏览器
    // "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
    // "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
    // "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
  },
];

export const detailSchemas: DescItem[] = [
  {
    field: 'username',
    label: '用户名',
  },
  {
    field: 'userCode',
    label: '工号',
  },
  {
    field: 'realName',
    label: '真实姓名',
  },
  {
    field: 'nickname',
    label: '昵称',
  },
  {
    field: 'wechatId',
    label: '微信号',
  },
  {
    field: 'mobile',
    label: '手机号',
  },
  {
    field: 'email',
    label: '邮箱',
  },
  {
    field: 'avatar',
    label: '头像',
  },
  {
    field: 'gender',
    label: '性别',
    render: (value) => {
      const color = value === '男' ? 'green' : 'red';
      const text = value;
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    field: 'status',
    label: '状态',
    render: (value) => {
      const color = value ? 'green' : 'red';
      const text = value ? '正常' : '禁用';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    label: '角色',
    field: 'roleName',
  },
  {
    field: 'deptName',
    label: '部门',
  },
  {
    field: 'job',
    label: '岗位',
  },
  {
    field: 'orderNo',
    label: '排序码',
  },
  {
    label: '生日',
    field: 'birthday',
    // render: (value) => {
    //   if (value) {
    //     return formatToDate(value, 'YYYY-MM-DD HH:MM:ss');
    //   }
    //   return null;
    // },
  },
  {
    label: '登录时间',
    field: 'loginTime',
    // render: (value) => {
    //   if (value) {
    //     return formatToDate(value, 'YYYY-MM-DD HH:MM:ss');
    //   }
    //   return null;
    // },
  },
  {
    label: '有效期',
    field: 'effectiveTime',
    // render: (value) => {
    //   if (value) {
    //     return formatToDate(value, 'YYYY-MM-DD HH:MM:ss');
    //   }
    //   return null;
    // },
  },
  {
    label: '创建时间',
    field: 'createTime',
    // render: (value) => {
    //   if (value) {
    //     return formatToDate(value, 'YYYY-MM-DD HH:MM:ss');
    //   }
    //   return null;
    // },
  },
  {
    label: '更新时间',
    field: 'updateTime',
    labelMinWidth: 60,
    // render: (value) => {
    //   if (value) {
    //     return formatToDate(value, 'YYYY-MM-DD HH:MM:ss');
    //   }
    //   return null;
    // },
  },
  {
    field: 'desc',
    label: '备注',
  },
];

// 基础设置 form
export const baseSetschemas: FormSchema[] = [
  {
    field: 'nickname',
    label: '昵称',
    component: 'Input',
  },
  {
    field: 'password',
    label: '密码',
    component: 'InputPassword',
    required: true,
    ifShow: true,
  },
  {
    field: 'wechatId',
    label: '微信号',
    component: 'Input',
  },
  {
    field: 'mobile',
    label: '手机号',
    component: 'Input',
  },
  {
    field: 'email',
    label: '邮箱',
    component: 'Input',
  },
  {
    field: 'birthday',
    label: '生日',
    component: 'DatePicker',
  },
  {
    label: '个人简介',
    field: 'desc',
    component: 'InputTextArea',
  },
  {
    field: 'username',
    label: '用户名',
    component: 'Input',
    dynamicDisabled: true,
  },
  {
    field: 'userCode',
    label: '工号',
    component: 'Input',
    dynamicDisabled: true,
  },
  {
    field: 'realName',
    label: '真实姓名',
    component: 'Input',
    dynamicDisabled: true,
  },
  {
    field: 'gender',
    label: '性别',
    component: 'Input',
    dynamicDisabled: true,
    colProps: { span: 12 },
  },
  {
    field: 'status',
    label: '状态',
    render: (value) => {
      const color = value ? 'green' : 'red';
      const text = value ? '正常' : '禁用';
      return h(Tag, { color: color }, () => text);
    },
    component: 'Input',
    dynamicDisabled: true,
    colProps: { span: 12 },
  },
  {
    field: 'deptName',
    label: '部门',
    component: 'Input',
    dynamicDisabled: true,
  },
  {
    field: 'job',
    label: '岗位',
    component: 'Input',
    dynamicDisabled: true,
  },
  {
    field: 'loginTime',
    label: '登录时间',
    component: 'Input',
    dynamicDisabled: true,
  },
  {
    field: 'effectiveTime',
    label: '有效期',
    component: 'Input',
    dynamicDisabled: true,
  },
  // {
  //   field: 'orderNo',
  //   label: '排序码',
  //   component: 'Input',
  //   dynamicDisabled: true,
  // },
];
