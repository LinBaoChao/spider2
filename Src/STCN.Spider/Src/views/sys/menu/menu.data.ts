import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';
import { h } from 'vue';
import { Tag } from 'ant-design-vue';
import { Icon } from '/@/components/Icon';

export const columns: BasicColumn[] = [
  {
    title: '显示名称',
    dataIndex: 'title',
    align: 'left',
  },
  {
    title: '功能名称',
    dataIndex: 'menuName',
    align: 'left',
  },
  {
    title: '权限标识',
    dataIndex: 'permission',
    align: 'left',
  },
  {
    title: '图标',
    dataIndex: 'icon',
    customRender: ({ record }) => {
      return h(Icon, { icon: record.icon });
    },
  },
  {
    title: '组件',
    dataIndex: 'component',
    align: 'left',
  },
  {
    title: '路径',
    dataIndex: 'path',
    align: 'left',
  },
  {
    title: '跳转',
    dataIndex: 'redirect',
    align: 'left',
  },
  {
    title: '类型',
    dataIndex: 'type',
    customRender: ({ record }) => {
      const status = record.type;
      if (status == 1) {
        return '目录';
      } else if (status == 2) {
        return '菜单';
      } else if (status == 3) {
        return '按钮';
      } else {
        return '其它';
      }
    },
  },
  {
    title: '是否菜单',
    dataIndex: 'isMenu',
    customRender: ({ record }) => {
      const status = record.isMenu;
      const enable = status == 1;
      const color = enable ? 'green' : 'red';
      const text = enable ? '是' : '不是';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '状态',
    dataIndex: 'status',
    customRender: ({ record }) => {
      const status = record.status;
      const enable = status == 1;
      const color = enable ? 'green' : 'red';
      const text = enable ? '启用' : '停用';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '是否可用',
    dataIndex: 'disabled',
    customRender: ({ record }) => {
      const status = record.disabled;
      const enable = status == 1;
      const color = !enable ? 'green' : 'red';
      const text = !enable ? '可用' : '不可用';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '是否显示',
    dataIndex: 'showMenu',
    customRender: ({ record }) => {
      const status = record.showMenu;
      const enable = status == 1;
      const color = enable ? 'green' : 'red';
      const text = enable ? '显示' : '隐藏';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '显示子菜单',
    dataIndex: 'hideChildrenInMenu',
    customRender: ({ record }) => {
      const status = record.hideChildrenInMenu;
      const enable = status == 1;
      const color = !enable ? 'green' : 'red';
      const text = !enable ? '显示' : '隐藏';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '排序',
    dataIndex: 'orderNo',
  },
  {
    title: '创建时间',
    dataIndex: 'createTime',
  },
];

const isDir = (type: number) => type === 1;
const isMenu = (type: number) => type === 2;
const isButton = (type: number) => type === 3;

export const searchFormSchema: FormSchema[] = [
  {
    field: 'menuName',
    label: '功能名称',
    component: 'Input',
    colProps: { span: 8 },
  },
  {
    field: 'status',
    label: '状态',
    component: 'Select',
    componentProps: {
      options: [
        { label: '启用', value: 1 },
        { label: '停用', value: 0 },
      ],
    },
    colProps: { span: 8 },
  },
];

export const formSchema: FormSchema[] = [
  {
    field: 'type',
    label: '类型',
    component: 'RadioButtonGroup',
    required: true,
    componentProps: {
      options: [
        { label: '目录', value: 1 },
        { label: '菜单', value: 2 },
        { label: '按钮', value: 3 },
      ],
    },
    colProps: { lg: 24, md: 24 },
  },
  {
    field: 'menuName',
    label: '功能名称',
    component: 'Input',
    required: true,
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'title',
    label: '显示名称',
    component: 'Input',
    required: true,
  },
  {
    field: 'permission',
    label: '权限标识',
    component: 'Input',
    required: true,
    // ifShow: ({ values }) => !isDir(values.type),
  },
  {
    field: 'path',
    label: '路由地址',
    component: 'Input',
    required: true,
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'component',
    label: '组件路径',
    component: 'Input',
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'redirect',
    label: '跳转',
    component: 'Input',
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'parentMenu',
    label: '上级功能',
    component: 'TreeSelect',
    componentProps: {
      replaceFields: {
        title: 'title',
        key: 'id',
        value: 'id',
      },
      getPopupContainer: () => document.body,
    },
  },
  {
    field: 'icon',
    label: '图标',
    component: 'IconPicker',
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'orderNo',
    label: '排序码',
    component: 'InputNumber',
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'status',
    label: '状态',
    component: 'RadioButtonGroup',
    defaultValue: 1,
    componentProps: {
      options: [
        { label: '启用', value: 1 },
        { label: '禁用', value: 0 },
      ],
    },
  },
  {
    field: 'isMenu',
    label: '是否菜单',
    component: 'RadioButtonGroup',
    defaultValue: 1,
    componentProps: {
      options: [
        { label: '是', value: 1 },
        { label: '否', value: 0 },
      ],
    },
    ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'disabled',
    label: '是否可用',
    component: 'RadioButtonGroup',
    defaultValue: 0,
    componentProps: {
      options: [
        { label: '可用', value: 0 },
        { label: '禁用', value: 1 },
      ],
    },
  },
  {
    field: 'showMenu',
    label: '是否显示',
    component: 'RadioButtonGroup',
    defaultValue: 1,
    componentProps: {
      options: [
        { label: '是', value: 1 },
        { label: '否', value: 0 },
      ],
    },
    // ifShow: ({ values }) => !isButton(values.type),
  },
  {
    field: 'hideChildrenInMenu',
    label: '显示子菜单',
    component: 'RadioButtonGroup',
    defaultValue: 0,
    componentProps: {
      options: [
        { label: '可用', value: 0 },
        { label: '禁用', value: 1 },
      ],
    },
    ifShow: ({ values }) => !isButton(values.type),
  },
];
