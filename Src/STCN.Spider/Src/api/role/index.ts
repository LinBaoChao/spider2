import { defHttp } from '/@/utils/http/axios';
import {
  RoleParams,
  RolePageParams,
  RolePageListGetResultModel,
  RoleListGetResultModel,
} from './model';

enum Api {
  setRoleStatus = '/role/setStatus',
  getListByPage = '/role/getListByPage',
  GetAllRoleList = '/role/getList',
  update = '/role/update',
  create = '/role/create',
  delete = '/role/delete',
}
export const getRoleListByPage = (params?: RolePageParams) =>
  defHttp.get<RolePageListGetResultModel>({ url: Api.getListByPage, params });

export const getRoleList = (params?: RoleParams) =>
  defHttp.get<RoleListGetResultModel>({ url: Api.GetAllRoleList, params });

export const setRoleStatus = (id: number, status: number) =>
  defHttp.post({ url: Api.setRoleStatus, params: { id, status } });

export const roleCreated = (params: any) =>
  defHttp.post({ url: Api.create, params: { params } }, { errorMessageMode: 'message' });

export const roleUpdated = (params: any) =>
  defHttp.post({ url: Api.update, params: { params } }, { errorMessageMode: 'message' });

export const roleDeleted = (id: number) =>
  defHttp.post({ url: Api.delete, params: { id } }, { errorMessageMode: 'message' });
