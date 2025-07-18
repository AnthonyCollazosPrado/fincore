<template>

  <Head title="Nuevo Prospecto" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col rounded-xl p-10 mt-[67px]">

      <div class="bg-purple-fincore rounded-t-xl p-5">
        <h1 class="m-0 text-white text-2xl font-bold">Nuevo Prospecto</h1>
      </div>
    
      <Card class="flex flex-col gap-0 inset-ring inset-ring-gray-50 shadow-none rounded-t-none rounded-b-xl mb-10 py-5">
        <CardHeader>
          <CardDescription class="text-black-fincore font-medium">Selecciona el tipo de producto:</CardDescription>
        </CardHeader>
        <CardContent>
          <Select v-model="tipoProductoElegido">
            <SelectTrigger className="w-full border border-gray-200 rounded-lg text-start h-[36px] py-[4px] px-3 mb-[20px] active:border-gray-200">
              <SelectValue placeholder="Tipo de producto" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectLabel>Elige el tipo</SelectLabel>
                <SelectItem v-for="item in tipoProducto" :key="item" :value="item">
                  {{ item }}
                </SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>

          <FormField v-if="mostrarTipoProducto" name="tipoProducto" v-slot="{ componentField }">
            <FormItem class="col-span-1 md:col-span-2 lg:col-span-3">
              <FormLabel class="block">Selecciona el tipo de documento:</FormLabel>
              <FormControl>
                <Select v-model="tipoDocumentoElegido">
                  <SelectTrigger className="w-full border border-gray-200 rounded-lg focus:border-gray-200 text-start h-[36px] py-[4px] px-3 mb-[20px] active:border-gray-200 col-span-1 md:col-span-2 lg:col-span-3">
                    <SelectValue placeholder="Tipo de documento"/>
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectLabel>Elige el tipo</SelectLabel>
                      <SelectItem v-for="item in tipoDocumento" :key="item" :value="item" class="">
                        {{ item }}
                      </SelectItem>
                    </SelectGroup>
                  </SelectContent>
                </Select>
              </FormControl>
            </FormItem>
          </FormField>

          <Ruc v-if="tipoDocumentoElegido === 'RUC'" class="col-span-1 md:col-span-2 lg:col-span-3" :tipoValue="tipoProductoElegido"/>
          <Dni v-if="tipoDocumentoElegido === 'DNI' && tipoProductoElegido === 'Factoring'" class="col-span-1 md:col-span-2 lg:col-span-3" />
          <Ce v-if="tipoDocumentoElegido === 'Carnet Extranjería' && tipoProductoElegido === 'Factoring'" class="col-span-1 md:col-span-2 lg:col-span-3" />

        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { ref, watch } from 'vue'

import {
  Card, CardHeader, CardTitle, CardDescription, CardContent,
} from '@/components/ui/card'

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import Ruc from './components/ruc.vue'
import Dni from './components/dni.vue'
import Ce from './components/ce.vue'
import { FormField } from '@/components/ui/form'
import FormItem from '@/components/ui/form/FormItem.vue'
import FormLabel from '@/components/ui/form/FormLabel.vue'
import FormControl from '@/components/ui/form/FormControl.vue'

const breadcrumbs = [
  { title: 'Prospectos', href: '/prospectos' },
  { title: 'Prospecto', href: '/prospectos/prospecto' },
]
const tipoProducto = ref(
  ['Factoring', 'Confirming']
)
const tipoProductoElegido = ref()
const tipoDocumento = ref(
  ['DNI', 'RUC', 'Carnet Extranjería']
)
const tipoDocumentoElegido = ref()
const mostrarTipoProducto = ref(false)

watch(tipoProductoElegido, (val) => {
  if (tipoProductoElegido.value == 'Factoring') tipoDocumento.value = ['DNI', 'RUC', 'Carnet Extranjería']
  if (tipoProductoElegido.value == 'Confirming') tipoDocumento.value = ['RUC']
  mostrarTipoProducto.value = true
})
</script>