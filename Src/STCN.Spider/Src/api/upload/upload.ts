import { UploadApiResult } from './uploadModel';
import { defHttp } from '/@/utils/http/axios';
import { UploadFileParams } from '/#/axios';
import { useGlobSetting } from '/@/hooks/setting';

const { uploadUrl = '' } = useGlobSetting();

enum Api {
  uploadAvatar = '/user/uploadAvatar',
}

/**
 * @description: Upload interface
 */
export function uploadAvatar(
  params: UploadFileParams,
  onUploadProgress: (progressEvent: ProgressEvent) => void,
) {
  return defHttp.uploadFile<UploadApiResult>(
    {
      url: uploadUrl + Api.uploadAvatar,
      onUploadProgress,
    },
    params,
  );
}
