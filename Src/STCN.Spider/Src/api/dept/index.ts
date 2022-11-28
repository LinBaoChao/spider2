import { defHttp } from '/@/utils/http/axios';
import { DeptParams, DeptListGetResultModel } from './model';

enum Api {
  GetList = '/dept/getList',
  GetListByPage = '/dept/getListByPage',
  create = '/dept/create',
  update = '/dept/update',
  delete = '/dept/delete',
}

export const getDeptList = (params?: DeptParams) =>
  defHttp.get<DeptListGetResultModel>({ url: Api.GetList, params });

export const getListByPage = (params?: DeptParams) =>
  defHttp.get<DeptListGetResultModel>({ url: Api.GetListByPage, params });

export const create = (params: any) =>
  defHttp.post({ url: Api.create, params: { params } }, { errorMessageMode: 'message' });

export const update = (params: any) =>
  defHttp.post({ url: Api.update, params: { params } }, { errorMessageMode: 'message' });

export const deptDelete = (id: number) =>
  defHttp.post({ url: Api.delete, params: { id } }, { errorMessageMode: 'message' });
