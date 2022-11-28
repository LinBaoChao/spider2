<template>
  <PageWrapper>
    <template #headerContent>
      <WorkbenchHeader />
    </template>
    <div class="items-center">
      <QuickNav :loading="loading" />
    </div>
  </PageWrapper>
</template>
<script lang="ts" setup>
  import { ref } from 'vue';
  // import { Card } from 'ant-design-vue';
  import { PageWrapper } from '/@/components/Page';
  import WorkbenchHeader from './components/WorkbenchHeader.vue';
  // import ProjectCard from './components/ProjectCard.vue';
  import QuickNav from './components/QuickNav.vue';
  // import DynamicInfo from './components/DynamicInfo.vue';
  // import SaleRadar from './components/SaleRadar.vue';

  const loading = ref(true);

  setTimeout(() => {
    loading.value = false;
  }, 1500);
</script>
