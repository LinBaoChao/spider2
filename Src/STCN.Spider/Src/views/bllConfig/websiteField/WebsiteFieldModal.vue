<template>
  <BasicModal v-bind="$attrs" @register="registerModal" :title="getTitle" @ok="handleSubmit">
    <BasicForm @register="registerForm" />
  </BasicModal>
</template>
<script lang="ts">
  import { defineComponent, ref, computed, unref } from 'vue';
  import { BasicModal, useModalInner } from '/@/components/Modal';
  import { BasicForm, useForm } from '/@/components/Form/index';

  import { formSchema } from './data';
  import {
    websiteFieldGetList,
    websiteFieldCreated,
    websiteFieldUpdated,
  } from '/@/api/websiteField';

  export default defineComponent({
    name: 'WebsiteFieldModal',
    components: { BasicModal, BasicForm },
    emits: ['success', 'register'],
    setup(_, { emit }) {
      const isUpdate = ref(true);
      const rowId = ref('');
      const websiteId = ref();

      const [registerForm, { setFieldsValue, updateSchema, resetFields, validate }] = useForm({
        labelWidth: 100,
        schemas: formSchema,
        showActionButtonGroup: false,
        actionColOptions: {
          span: 23,
        },
      });

      const [registerModal, { setModalProps, closeModal }] = useModalInner(async (data) => {
        resetFields();
        setModalProps({ confirmLoading: false });
        isUpdate.value = !!data?.isUpdate;
        websiteId.value = data?.websiteId;

        if (unref(isUpdate)) {
          rowId.value = data.record.id;
          setFieldsValue({
            ...data.record,
          });
        }

        const treeData = await websiteFieldGetList({
          websiteId: websiteId.value,
        });
        updateSchema({
          field: 'parentId',
          componentProps: { treeData },
        });

        // updateSchema([
        //   {
        //     field: 'websiteId',
        //     defaultValue: websiteId.value,
        //     show: !unref(isUpdate),
        //   },
        // ]);
      });

      const getTitle = computed(() => (!unref(isUpdate) ? '新增' : '编辑'));

      async function handleSubmit() {
        try {
          const values = await validate();
          setModalProps({ confirmLoading: true });
          if (!unref(isUpdate)) {
            await websiteFieldCreated({ ...values, websiteId: websiteId.value });
          } else {
            await websiteFieldUpdated({ ...values, id: rowId.value, websiteId: websiteId.value });
            closeModal();
          }

          emit('success', { isUpdate: unref(isUpdate), values: { ...values, id: rowId.value } });
          // } catch (err) {
          //   notification.error({
          //     message: `操作失败：${err}`,
          //   });
        } finally {
          setModalProps({ confirmLoading: false });
        }
      }

      return { registerModal, registerForm, getTitle, handleSubmit };
    },
  });
</script>
