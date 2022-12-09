import { defHttp } from '/@/utils/http/axios';
import { WebsiteParams, WebsiteListResult } from './model';

enum Api {
  getListByPage = '/website/getListByPage',
  create = '/website/create',
  update = '/website/update',
  delete = '/website/delete',
}

export const websiteGetListByPage = (params: WebsiteParams) =>
  defHttp.get<WebsiteListResult>({ url: Api.getListByPage, params });

export const websiteCreated = (params: any) =>
  defHttp.post({ url: Api.create, params: { params } }, { errorMessageMode: 'message' });

export const websiteUpdated = (params: any) =>
  defHttp.post({ url: Api.update, params: { params } }, { errorMessageMode: 'message' });

export const websiteDeleted = (id: number) =>
  defHttp.post({ url: Api.delete, params: { id } }, { errorMessageMode: 'message' });
