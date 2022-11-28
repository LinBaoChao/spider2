import { defHttp } from '/@/utils/http/axios';
import { MenuParams, RouteMenuListResultModel, MenuListGetResultModel } from './model';

enum Api {
  getRouteMenuList = '/menu/getRouteMenuList',
  getMenuPermission = '/menu/getMenuPermission',
  getPermCode = '/menu/getPermissionCode',
  create = '/menu/create',
  update = '/menu/update',
  delete = '/menu/delete',
}

/**
 * @description: Get user menu based on id
 */

export const getRouteMenuList = () => {
  return defHttp.get<RouteMenuListResultModel>({ url: Api.getRouteMenuList });
};

export const getMenuPermission = (params?: MenuParams) =>
  defHttp.get<MenuListGetResultModel>({ url: Api.getMenuPermission, params });

export const create = (params: any) =>
  defHttp.post({ url: Api.create, params: { params } }, { errorMessageMode: 'message' });

export const update = (params: any) =>
  defHttp.post({ url: Api.update, params: { params } }, { errorMessageMode: 'message' });

export const menuDelete = (id: number) =>
  defHttp.post({ url: Api.delete, params: { id } }, { errorMessageMode: 'message' });

export function getPermCode() {
  return defHttp.get<string[]>({ url: Api.getPermCode });
}
