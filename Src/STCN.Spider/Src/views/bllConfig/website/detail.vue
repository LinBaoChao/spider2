<template>
  <BasicDrawer v-bind="$attrs" @register="registerDrawer" :title="getTitle" width="700px">
    <Description @register="registerDescription" />
  </BasicDrawer>
</template>
<!-- destroyOnClose BasicDrawer里如果加上这个属性，则发布版本打开这个页面后再关闭之后再打开就没数据了除非刷新整个页面，但开环境是正常的。所以不能加这个属性-->
<script lang="ts">
  import { defineComponent, ref } from 'vue';
  import { BasicDrawer, useDrawerInner } from '/@/components/Drawer';
  import { Description, useDescription } from '/@/components/Description/index';
  // import { detail } from '/@/api/user';
  import { detailSchemas } from './data';

  export default defineComponent({
    name: 'UserDetail',
    components: { BasicDrawer, Description },
    setup() {
      const getTitle = ref('详细信息');
      const model = ref([]);

      const [registerDrawer] = useDrawerInner(async (data) => {
        // const data = await detail(id);
        getTitle.value = data.realName + '的详细信息';
        model.value = data;
      });
      const [registerDescription] = useDescription({
        column: 2,
        data: model,
        schema: detailSchemas,
        size: 'middle',
        class: 'enter-y',
      });
      return {
        getTitle,
        model,
        detailSchemas,
        registerDrawer,
        registerDescription,
      };
    },
  });
</script>
