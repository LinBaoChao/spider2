import { defHttp } from '/@/utils/http/axios';
import { SpiderParams, SpiderListResult } from './model';

enum Api {
  List = '/spider/getListByPage',
  Delete = '/spider/delete',
}

export const spiderList = (params: SpiderParams) =>
  defHttp.get<SpiderListResult>({ url: Api.List, params });

export const spiderDelete = (id: number) =>
  defHttp.post({ url: Api.Delete, params: { id } }, { errorMessageMode: 'message' });
