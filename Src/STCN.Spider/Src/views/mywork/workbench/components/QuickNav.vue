<!-- <template>
  <Card title="快捷导航" v-bind="$attrs">
    <template v-for="item in items" :key="item">
      <CardGrid @click="goto(item.url)" style="cursor:pointer;width:120px;">
        <span class="flex flex-col items-center">
          <Icon :icon="item.icon" :color="item.color" size="20" />
          <span class="text-md mt-2">{{ item.title }}</span>
        </span>
      </CardGrid>
    </template>
  </Card>

  <div  class="flex flex-row items-center" style="width:400px;flex-wrap: wrap;">
<span v-for="item in items" :key="item" class="flex flex-col items-center"  style="width:120px;">
  <Icon :icon="item.icon" :color="item.color" size="20" />
  <span class="text-md mt-2">{{ item.title }}</span>
</span>
</div>
   

</template> -->

<template class="items-center">
  <Card title="快捷导航" v-bind="$attrs">
    <div class="flex flex-row items-center" style="flex-wrap: wrap; width: 400px">
      <CardGrid
        @click="goto(item.url)"
        style="cursor: pointer; width: 120px"
        v-for="item in items"
        :key="item"
        v-auth="item.permissionCode"
      >
        <span class="flex flex-col items-center" style="margin-bottom: 40px">
          <Icon :icon="item.icon" :color="item.color" size="20" />
          <span class="text-md mt-2">{{ item.title }}</span>
        </span>
      </CardGrid>
    </div>
  </Card>
</template>
<style scoped></style>
<script lang="ts">
  import { defineComponent } from 'vue';
  import { Card } from 'ant-design-vue';
  import { navItems } from './data';
  import { Icon } from '/@/components/Icon';
  import { useGo } from '/@/hooks/web/usePage';
  import { usePermission } from '/@/hooks/web/usePermission';

  export default defineComponent({
    components: { Card, CardGrid: Card.Grid, Icon },
    setup() {
      const go = useGo();
      const { hasPermission } = usePermission();

      function goto(url) {
        go(url);
      }

      return { items: navItems, goto, hasPermission };
    },
  });
</script>

<!-- <script lang="ts" setup>
  import { Card } from 'ant-design-vue';
  import { navItems } from './data';
  import { Icon } from '/@/components/Icon';
  import { useGo } from '/@/hooks/web/usePage';

  const go = useGo();
  const CardGrid = Card.Grid;

  function goto(url) {
    go(url);
  }
</script> -->
