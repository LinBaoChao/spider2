import { defHttp } from '/@/utils/http/axios';
import { SearchParams, ListResult } from './model';

enum Api {
  getList = '/websiteField/getList',
  create = '/websiteField/create',
  update = '/websiteField/update',
  delete = '/websiteField/delete',
}

export const websiteFieldGetList = (params: SearchParams) =>
  defHttp.get<ListResult>({ url: Api.getList, params });

export const websiteFieldCreated = (params: any) =>
  defHttp.post({ url: Api.create, params: { params } }, { errorMessageMode: 'message' });

export const websiteFieldUpdated = (params: any) =>
  defHttp.post({ url: Api.update, params: { params } }, { errorMessageMode: 'message' });

export const websiteFieldDeleted = (id: number) =>
  defHttp.post({ url: Api.delete, params: { id } }, { errorMessageMode: 'message' });
