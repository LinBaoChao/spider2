import { BasicPageParams, BasicFetchResult } from '/@/api/model/baseModel';

export type DeptParams = {
  deptName?: string;
  status?: number;
};

export interface DeptListItem {
  id: string;
  deptName: string;
  parentId: number;
  orderNo: string;
  createTime: string;
  desc: string;
  status: number;
}

export type DeptListGetResultModel = BasicFetchResult<DeptListItem>;
