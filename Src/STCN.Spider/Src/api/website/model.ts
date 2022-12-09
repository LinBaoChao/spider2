import { BasicPageParams, BasicFetchResult } from '/@/api/model/baseModel';

export type WebsiteParams = BasicPageParams & {
  keyword?: string;
  status?: number;
};

/**
 * @description: Get spider list return value
 */
export interface WebsiteListModel {
  id: string | number;
  parentId?: number;
  mediaName: string;
  productName?: string;
  platform?: string;
  channel?: string;
  name: string;
  domains?: string;
  scanUrls: string;
  listUrls?: string;
  contentUrls?: string;
  inputEncoding?: string;
  outputEncoding?: string;
  userAgent?: string;
  clientIp?: string;
  tasknum?: number;
  multiserver?: boolean;
  serverid?: number;
  saveRunningState?: boolean;
  interval?: number;
  timeout?: number;
  maxTry?: number;
  maxDepth?: number;
  maxFields?: number;
  status?: number;
  createTime: Nullable<Date>;
  updateTime: Nullable<Date>;
}

/**
 * @description: Request list return value
 */
export type WebsiteListResult = BasicFetchResult<WebsiteListModel>;
