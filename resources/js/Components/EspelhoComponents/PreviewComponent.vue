<script setup lang="ts">
import {GrupoPromotoria} from "@/Interfaces/GrupoPromotoria";
import {Atribuicoes} from "@/Interfaces/Atribuicoes";
import {UrgenciaAtendimento} from "@/Interfaces/UrgenciaAtendimento";

import { ref, watchEffect } from 'vue';

const props = defineProps({
    periodoEspelho: {
        type: Array as () => string[],
        required: true,
    },
    grupoPromotoriaDeTodasAsPromotorias: {
        type: Array as () => GrupoPromotoria[],
        required: true,
    },
    listaAtribuicoes: {
        type: Array as () => Atribuicoes[],
        required: true,
    },
    atendimentosUrgenciaDados: {
        type: Array as () => UrgenciaAtendimento[],
        required: true,
    },
});

const promotoriasMacapa = ref<GrupoPromotoria[]>([]);
const promotoriasSantana = ref<GrupoPromotoria[]>([]);
const promotoriasInterior = ref<GrupoPromotoria[]>([]);

watchEffect(() => {
    const municipios : Record<string, GrupoPromotoria[]> = {
        'Macapa': [],
        'Santana': [],
        'Interior': []
    };

    if (props.grupoPromotoriaDeTodasAsPromotorias.length === 0) {
        promotoriasMacapa.value = [];
        promotoriasSantana.value = [];
        promotoriasInterior.value = [];
        return;
    }
    props.grupoPromotoriaDeTodasAsPromotorias.forEach((grupoPromotoria) => {
        const municipioNome = grupoPromotoria?.municipio?.nome;
        if (municipioNome === 'Macapá') {
            municipios['Macapa'].push(grupoPromotoria);
        }
        else if (municipioNome === 'Santana') {
            municipios['Santana'].push(grupoPromotoria);
        }
        else {
            if (municipios['Interior'].findIndex((grupo) => grupo.nome === grupoPromotoria.nome) === -1) {
                municipios['Interior'].push(grupoPromotoria);
            }
        }
    });

    promotoriasMacapa.value = municipios['Macapa'];
    promotoriasSantana.value = municipios['Santana'];
    promotoriasInterior.value = municipios['Interior'];
});
</script>

<template>
    <Card>
        <CardHeader>
            <div class="w-full flex justify-center items-center">
                <div class="w-full flex flex-col items-center space-y-16">
                    <div class="flex flex-col items-center">
                        <a href="https://www.mpap.mp.br" target="_blank" class="flex flex-col items-center">
                            <div class="h-16 w-auto sm:h-20">
                                <img alt="MPAP Logo"
                                class="h-16 w-auto sm:h-20"
                                src="https://www.mpap.mp.br/templates/portal/images/logo-mpap.png"
                                >
                            </div>
                            <h1 class="font-bold text-gray-700 dark:text-gray-200">
                                Procuradoria Geral de Justiça
                            </h1>
                        </a>

                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Procuradorias de Justiça do Estado do Amapá
                        </div>
                        <div v-if="periodoEspelho.length > 0" class="text-sm text-gray-500 dark:text-gray-400">
                            <span v-if="periodoEspelho[0] === periodoEspelho[1]">
                                Espelho de {{ periodoEspelho[0] }}
                            </span>
                            <span v-else>
                                Espelho de {{ periodoEspelho[0] }} a {{ periodoEspelho[1] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </CardHeader>
        <CardContent class="flex flex-col items-center space-y-8 w-full">
            <EntranciaFinalMacapaPreview
                v-if="promotoriasMacapa.length > 0 || props.atendimentosUrgenciaDados.length > 0"
                :grupoPromotorias="promotoriasMacapa"
                :urgenciaAtendimentos="props.atendimentosUrgenciaDados"
            />
            <EntranciaFinalSantanaPreview
                v-if="promotoriasSantana.length > 0"
                :grupoPromotorias="promotoriasSantana"
            />
            <EntranciaInicialPreview
                v-if="promotoriasInterior.length > 0"
                :promotoriasDados="promotoriasInterior"
            />
            <TabelaPromotoresSubstitutosPreview
                :listaAtribuicoes="listaAtribuicoes"
            />
        </CardContent>
    </Card>
</template>