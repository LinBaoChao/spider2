import { defHttp } from '/@/utils/http/axios';

enum Api {
  GetPermCode = '/permission/getPermissionCode',
}

export function getPermCode() {
  return defHttp.get<string[]>({ url: Api.GetPermCode });
}
