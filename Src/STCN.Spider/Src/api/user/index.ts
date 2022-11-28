import { defHttp } from '/@/utils/http/axios';
import {
  LoginParams,
  UserParams,
  LoginResultModel,
  GetUserInfoModel,
  UserListGetResultModel,
} from './model';

import { ErrorMessageMode } from '/#/axios';

enum Api {
  Login = '/user/login',
  Logout = '/user/logout',
  SessionTimeout = '/user/sessionTimeout',
  TokenExpired = '/user/tokenExpired',
  IsExist = '/user/isExist',
  GetUserInfo = '/user/getUserInfo',
  List = '/user/getListByPage',
  Create = '/user/create',
  Update = '/user/update',
  Delete = '/user/delete',
  UpdateUserInfo = '/user/updateUserInfo',
}

/**
 * @description: user login api
 */
export function loginApi(params: LoginParams, mode: ErrorMessageMode = 'modal') {
  return defHttp.post<LoginResultModel>(
    {
      url: Api.Login,
      params,
    },
    {
      errorMessageMode: mode,
    },
  );
}

export function doLogout() {
  return defHttp.get({ url: Api.Logout });
}

export const sessionTimeout = () => defHttp.post<void>({ url: Api.SessionTimeout });

export const tokenExpired = () => defHttp.post<void>({ url: Api.TokenExpired });

export const isExist = (userName: string) =>
  defHttp.post({ url: Api.IsExist, params: { userName } }, { errorMessageMode: 'none' });

export const getUserList = (params: UserParams) =>
  defHttp.get<UserListGetResultModel>({ url: Api.List, params });

/**
 * @description: getUserInfo
 */
export function getUserInfo() {
  return defHttp.get<GetUserInfoModel>({ url: Api.GetUserInfo }, { errorMessageMode: 'none' });
}

export const userCreated = (params: any) =>
  defHttp.post({ url: Api.Create, params: { params } }, { errorMessageMode: 'message' });
export const userUpdated = (params: any) =>
  defHttp.post({ url: Api.Update, params: { params } }, { errorMessageMode: 'message' });
export const updateUserInfo = (params: any) =>
  defHttp.post({ url: Api.UpdateUserInfo, params: { params } }, { errorMessageMode: 'message' });
export const userDeleted = (id: number) =>
  defHttp.post({ url: Api.Delete, params: { id } }, { errorMessageMode: 'message' });
