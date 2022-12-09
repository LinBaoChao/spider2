import { BasicPageParams, BasicFetchResult } from '/@/api/model/baseModel';

export type SearchParams = {
  keyword?: string;
  status?: number;
};

/**
 * @description: Get spider list return value
 */
export interface ListModel {
  id: string | number;
  parentId?: number;
  website_id: number;
  name: string;
  selector?: string;
  selectorType?: string;
  required?: boolean;
  repeated?: boolean;
  sourceType?: string;
  attachedUrl: string;
  isWriteDb?: boolean;
  joinField?: string;
  filter?: string;
  status?: number;
  interval?: number;
  createTime: Nullable<Date>;
  updateTime: Nullable<Date>;
}

/**
 * @description: Request list return value
 */
export type ListResult = BasicFetchResult<ListModel>;
