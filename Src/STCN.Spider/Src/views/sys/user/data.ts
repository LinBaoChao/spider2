import { viteImagemin } from 'vite-plugin-imagemin';
import { h, Slots } from 'vue';
import { Tag } from 'ant-design-vue';
import { isExist } from '/@/api/user';
import { DescItem } from '/@/components/Description/src/typing';
import { getRoleList } from '/@/api/role';
import { BasicColumn } from '/@/components/Table';
import { FormSchema } from '/@/components/Table';
import { commonTagRender } from '/@/utils/tagUtil';
import { EnableSelectOptions, EnableRadioOptions } from '/@/utils/status';
import { SexOptions, Sex } from '/@/utils/sex';
import { formatToDate } from '/@/utils/dateUtil';
import { Rule } from '/@/components/Form';
import { usePermission } from '/@/hooks/web/usePermission';

const { hasPermission } = usePermission();

export const columns: BasicColumn[] = [
  {
    title: '用户名',
    dataIndex: 'username',
    width: 120,
  },
  {
    title: '真实姓名',
    dataIndex: 'realName',
    width: 120,
  },
  {
    title: '工号',
    dataIndex: 'userCode',
    width: 120,
  },
  {
    title: '昵称',
    dataIndex: 'nickname',
    width: 120,
  },
  {
    title: '性别',
    dataIndex: 'gender',
    width: 120,
  },
  {
    title: '部门',
    dataIndex: 'deptName',
    width: 120,
  },
  {
    title: '角色',
    dataIndex: 'roleName',
    width: 120,
  },
  {
    title: '微信号',
    dataIndex: 'wechatId',
    width: 120,
  },
  {
    title: '邮箱',
    dataIndex: 'email',
    width: 120,
  },
  {
    title: '电话',
    dataIndex: 'mobile',
    width: 120,
  },
  {
    dataIndex: 'birthday',
    title: '生日',
    width: 180,
  },
  {
    title: '创建时间',
    dataIndex: 'createTime',
    width: 180,
  },
  {
    title: '更新时间',
    dataIndex: 'updateTime',
    width: 180,
  },
  {
    title: '登录时间',
    dataIndex: 'loginTime',
    width: 180,
  },
  {
    title: '有效期',
    dataIndex: 'effectiveTime',
    width: 180,
  },
  {
    title: '状态',
    dataIndex: 'status',
    width: 100,
    customRender: ({ record }) => {
      const enable = record.status;
      const color = enable ? 'green' : 'red';
      const text = enable ? '正常' : '禁用';
      return h(Tag, { color: color }, () => text);
    },
  },
  {
    title: '排序',
    dataIndex: 'orderNo',
    width: 120,
  },
  {
    title: '备注',
    dataIndex: 'desc',
  },
];

export const searchFormSchema: FormSchema[] = [
  {
    field: 'keyword',
    label: '关键词',
    component: 'Input',
    colProps: { span: 8 },
  },
];

export const accountFormSchema: FormSchema[] = [
  {
    field: 'username',
    label: '用户名',
    component: 'Input',
    helpMessage: ['请输入新用户', '用户名不能重复'],
    rules: [
      {
        required: true,
        message: '请输入用户名',
      },
      // {
      //   validator(_, value) {
      //     return new Promise((resolve, reject) => {
      //       isExist(value)
      //         .then((res) => {
      //           console.log(res);
      //           if (res) {
      //             reject('用户名已存在');
      //           }
      //           return resolve(res);
      //         })
      //         .catch((err) => {
      //           reject(err.message || '验证失败');
      //         });
      //     });
      //   },
      //   trigger: 'blur',
      // },
    ],
  },
  {
    field: 'userCode',
    label: '工号',
    component: 'Input',
    helpMessage: ['请输入工号', '工号不能重复'],
    rules: [
      {
        required: true,
        message: '请输入工号',
      },
      // {
      //   validator(_, value) {
      //     return new Promise((resolve, reject) => {
      //       isExist(value)
      //         .then((res) => {
      //           console.log(res);
      //           if (res) {
      //             reject('工号已存在');
      //           }
      //           return resolve(res);
      //         })
      //         .catch((err) => {
      //           reject(err.message || '验证失败');
      //         });
      //     });
      //   },
      //   trigger: 'blur',
      // },
    ],
  },
  {
    field: 'realName',
    label: '真实姓名',
    component: 'Input',
    required: true,
  },
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
    field: 'gender',
    label: '性别',
    component: 'RadioButtonGroup',
    required: true,
    componentProps: {
      options: [
        { label: '男', value: '男' },
        { label: '女', value: '女' },
      ],
    },
    colProps: { span: 12 },
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
    label: '角色',
    field: 'roleId',
    component: 'ApiSelect',
    componentProps: {
      api: getRoleList,
      labelField: 'roleName',
      valueField: 'id',
      mode: 'multiple',
      placeholder: '请选择角色',
    },
    required: false,
    ifShow: hasPermission('Sys.User.AssignRoles'),
  },
  {
    field: 'deptId',
    label: '部门',
    component: 'TreeSelect',
    componentProps: {
      replaceFields: {
        title: 'deptName',
        key: 'id',
        value: 'id',
      },
      getPopupContainer: () => document.body,
      placeholder: '请选择部门',
      multiple: true,
    },
    required: false,
  },
  {
    label: '排序码',
    field: 'orderNo',
    component: 'InputNumber',
  },
  {
    label: '备注',
    field: 'desc',
    component: 'InputTextArea',
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
  // {
  //   label: '拥有角色',
  //   field: 'roles',
  //   span: 2,
  //   render: (value: any) => {
  //     const tags = [];
  //     for (const info of value) {
  //       const color = info.enable ? 'blue' : 'red';
  //       tags.push(commonTagRender(color, info.name));
  //     }
  //     return tags;
  //   },
  // },
  // {
  //   label: '所属机构',
  //   field: 'organizations',
  //   span: 2,
  //   render: (value: any) => {
  //     const tags = [];
  //     for (const info of value) {
  //       const color = 'blue';
  //       tags.push(commonTagRender(color, info.organizationName));
  //     }
  //     return tags;
  //   },
  // },
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
