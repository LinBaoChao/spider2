<template>
  <CollapseContainer
    title="个人设置"
    :canExpan="false"
    v-loading="loadingRef"
    loading-tip="加载中..."
  >
    <a-row :gutter="24">
      <a-col :span="14">
        <BasicForm @register="register" />
      </a-col>
      <a-col :span="10">
        <div class="change-avatar">
          <div class="mb-2">头像</div>
          <CropperAvatar
            :uploadApi="uploadAvatar"
            :value="avatar"
            btnText="更换头像"
            :btnProps="{ preIcon: 'ant-design:cloud-upload-outlined' }"
            @change="updateAvatar"
            width="150"
          />
        </div>
        <!-- <BasicUpload :maxSize="20" :maxNumber="10" @change="handleChange" :api="uploadApi" /> -->
        <!-- <div>
          <CropperImage ref="refCropper" :src="img" @cropend="handleCropend" style="width: 40vw" />
        </div> -->
      </a-col>
    </a-row>
    <div style="text-align: center">
      <Button
        type="primary"
        @click="handleSubmit"
        v-if="hasPermission('Sys.User.UserDetail.Update')"
      >
        更新基本信息
      </Button>
    </div>
  </CollapseContainer>
</template>
<script lang="ts">
  import { Button, Row, Col } from 'ant-design-vue';
  import { computed, defineComponent, onMounted, ref } from 'vue';
  import { BasicForm, useForm } from '/@/components/Form/index';
  import { CollapseContainer } from '/@/components/Container';
  import { CropperAvatar, CropperImage } from '/@/components/Cropper';
  import { useMessage } from '/@/hooks/web/useMessage';

  import headerImg from '/@/assets/images/header.jpg';
  import { getUserInfo, updateUserInfo } from '/@/api/user';
  import { baseSetschemas } from './data';
  import { useUserStore } from '/@/store/modules/user';
  import { uploadAvatar } from '/@/api/upload/upload';

  import img from '/@/assets/images/header.jpg';
  import { BasicUpload } from '/@/components/Upload';
  import { usePermission } from '/@/hooks/web/usePermission';

  export default defineComponent({
    components: {
      BasicForm,
      CollapseContainer,
      Button,
      ARow: Row,
      ACol: Col,
      CropperAvatar,
      CropperImage,
      BasicUpload,
    },
    setup() {
      const info = ref('');
      const cropperImg = ref('');
      const { hasPermission } = usePermission();

      function handleCropend({ imgBase64, imgInfo }) {
        info.value = imgInfo;
        console.log(imgInfo);
        console.log(imgBase64);
        cropperImg.value = imgBase64;
      }

      const { notification } = useMessage();
      const userStore = useUserStore();
      const loadingRef = ref(false);

      const [register, { setFieldsValue, validate }] = useForm({
        labelWidth: 120,
        schemas: baseSetschemas,
        showActionButtonGroup: false,
      });

      onMounted(async () => {
        const data = await getUserInfo();
        setFieldsValue(data);
      });

      const avatar = computed(() => {
        const { avatar } = userStore.getUserInfo;
        return avatar || headerImg;
      });

      function updateAvatar(src: string) {
        const userinfo = userStore.getUserInfo;
        userinfo.avatar = src;
        userStore.setUserInfo(userinfo);
      }

      async function handleSubmit() {
        const values = await validate();
        loadingRef.value = true;
        const userinfo = userStore.getUserInfo;
        await updateUserInfo({ ...values, id: userinfo.userId });
        loadingRef.value = false;
        notification.success({
          message: '更新成功！',
        });
      }

      return {
        avatar,
        register,
        uploadAvatar: uploadAvatar as any,
        updateAvatar,
        handleSubmit,
        hasPermission,
        img,
        info,
        cropperImg,
        handleCropend,
        handleChange: (list: string[]) => {
          createMessage.info(`已上传文件${JSON.stringify(list)}`);
        },
      };
    },
  });
</script>

<style lang="less" scoped>
  .change-avatar {
    img {
      display: block;
      margin-bottom: 15px;
      border-radius: 50%;
    }
  }
</style>
