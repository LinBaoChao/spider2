import { BasicPageParams, BasicFetchResult } from '/@/api/model/baseModel';

/**
 * @description: Login interface parameters
 */
export interface LoginParams {
  username: string;
  password: string;
}

export interface RoleInfo {
  roleName: string;
  value: string;
}

/**
 * @description: Login interface return value
 */
export interface LoginResultModel {
  userId: string | number;
  token: string;
  role: RoleInfo;
}

export type UserParams = BasicPageParams & {
  username?: string;
  nickname?: string;
};

export interface UserListItem {
  id: string;
  username: string;
  email: string;
  nickname: string;
  role: string;
  createTime: string;
  desc: string;
  status: number;
}

/**
 * @description: Get user information return value
 */
export interface GetUserInfoModel {
  roles: RoleInfo[];
  // 用户id
  userId: string | number;
  // 用户名
  username: string;
  // 真实名字
  realName: string;
  // 头像
  avatar: string;
  // 介绍
  desc?: string;
}

/**
 * @description: Get user list return value
 */
export interface GetUserListModel {
  roles: RoleInfo[];
  // 用户id
  userId: string | number;
  userCode: string;
  // 用户名
  userName: string;
  // 真实名字
  realName: string;
  // 头像
  avatar: string;
  // 介绍
  desc?: string;
  nickname: string;
  gender: string;
  birthday: Nullable<Date>;
  wechatId: string;
  email: string;
  telephone: string;
  job: string;
  orderNo: Nullable<number>;
  status: number;
  loginTime: Nullable<Date>;
  effectiveTime: Nullable<Date>;
  createTime: Date;
  updateTime: Nullable<Date>;
}

/**
 * @description: Request list return value
 */
export type UserListGetResultModel = BasicFetchResult<UserListItem>;
