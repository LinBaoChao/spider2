import { BasicPageParams, BasicFetchResult } from '/@/api/model/baseModel';

export type SpiderParams = BasicPageParams & {
  keyword?: string;
};

/**
 * @description: Get spider list return value
 */
export interface SpiderListModel {
  id: string | number;
  source: string;
  quote?: string;
  title: string;
  content: string;
  author: string;
  editor?: string;
  url: string;
  newsType?: string;
  terminalType?: string;
  country?: string;
  area?: string;
  status: number;
  publishTime: Nullable<Date>;
  createTime: Nullable<Date>;
  updateTime: Nullable<Date>;
}

/**
 * @description: Request list return value
 */
export type SpiderListResult = BasicFetchResult<SpiderListModel>;
