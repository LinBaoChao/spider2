import { BasicFetchResult } from '/@/api/model/baseModel';

import type { RouteMeta } from 'vue-router';
export interface RouteItem {
  path: string;
  component: any;
  meta: RouteMeta;
  name?: string;
  alias?: string | string[];
  redirect?: string;
  caseSensitive?: boolean;
  children?: RouteItem[];
}

export interface MenuListItem {
  id: string;
  menuName: string;
  title: string;
  orderNo: string;
  createTime: string;
  status: number;
  icon: string;
  component: string;
  permission: string;
}

export type MenuParams = {
  menuName?: string;
  status?: string;
};

/**
 * @description: Get menu return value
 */
export type RouteMenuListResultModel = RouteItem[];

export type MenuListGetResultModel = BasicFetchResult<MenuListItem>;
