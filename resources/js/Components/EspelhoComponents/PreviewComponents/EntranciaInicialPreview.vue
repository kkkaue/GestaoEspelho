<script setup lang="ts">
import { GrupoPromotoria } from '@/types';

defineProps({
  promotoriasDados: {
    type: Array as () => GrupoPromotoria[],
    required: true,
  },
});
</script>

<template>
  <div class="max-w-5xl w-full mx-auto flex flex-col items-center space-y-4" v-if="promotoriasDados.length > 0">
    <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">
      Entrância Inicial
    </h1>
    <TabelaPromotoriaPreview
     :grupoPromotorias="promotoriasDados"
    />
  </div>
</template>
