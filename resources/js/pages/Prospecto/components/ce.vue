<template>


          <form @submit.prevent="guardarProspecto" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="hidden">
              <FormField name="tipo" v-slot="{ componentField }">
                <FormItem>
                  <FormLabel class="block">tipo</FormLabel>
                  <FormControl>
                    <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                  </FormControl>
                </FormItem>
              </FormField>
            </div>

            <FormField class="" name="ce" v-slot="{ componentField }">
              <FormItem class="!hidden">
                <FormLabel class="block">CE<span class="text-red-600">*</span></FormLabel>
                <FormControl>
                  <Input id="ce" v-bind="componentField" @blur="consultarRuc" @keyup.enter="consultarRuc"
                    class="w-full shadow-none rounded-lg border-gray-200" :disabled="consultandoRuc" />
                </FormControl>
                <p v-if="componentField.errorMessage" class="text-red-600 text-sm mt-1">
                  {{ componentField.errorMessage }}
                </p>
                <p v-if="consultandoRuc" class="text-blue-600 text-sm mt-1">
                  Consultando RUC...
                </p>
              </FormItem>
            </FormField>




            <div class="flex-1 space-y-1.5">
                <Label for="reporte" class="text-sm font-medium pb-3">Carnet Extranjería</Label>
                <Button variant="outline" class="w-full bg-skyblue-fincore border-0 text-white" as="label" :disabled="isUploading">
                    <UploadCloud class="w-4 h-4 mr-2" />
                    {{ isUploading ? 'Procesando...' : 'Subir documento' }}
                    <input id="reporte" type="file" class="hidden" accept=".pdf" @change="handleFileUpload"
                        :disabled="isUploading" />
                </Button>
                <p v-if="uploadedFileName" class="text-sm text-green-600">
                    Archivo cargado: {{ uploadedFileName }}
                </p>
            </div>


            <FormField name="activity_start_date" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Fecha de Inscripción</FormLabel>
                <FormControl>
                  <Input type="date" class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
                <p v-if="componentField.errorMessage" class="text-red-600 text-sm mt-1">
                  {{ componentField.errorMessage }}
                </p>
              </FormItem>
            </FormField>


            
            <FormField name="sales_executive" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Ejecutivo Comercial</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
                <p v-if="componentField.errorMessage" class="text-red-600 text-sm mt-1">
                  {{ componentField.errorMessage }}
                </p>
              </FormItem>
            </FormField>




            
            <FormField name="nombre" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Nombres y Apellidos</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
              </FormItem>
            </FormField>


            <FormField name="address" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Dirección <span class="text-red-600">*</span></FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
                <p v-if="componentField.errorMessage" class="text-red-600 text-sm mt-1">
                  {{ componentField.errorMessage }}
                </p>
              </FormItem>
            </FormField>


            <FormField name="fecha_nacimiento" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Fecha de Nacimiento</FormLabel>
                <FormControl>
                  <Input type="date" class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
                <p v-if="componentField.errorMessage" class="text-red-600 text-sm mt-1">
                  {{ componentField.errorMessage }}
                </p>
              </FormItem>
            </FormField>
            <FormField name="sexo" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Sexo</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
              </FormItem>
            </FormField>
            <FormField name="estado_civil" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Estado Civil</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
              </FormItem>
            </FormField>



            <FormField name="expected_rate" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Tasa Esperada (%)</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" type="number" v-bind="componentField" />
                </FormControl>
              </FormItem>
            </FormField>
            
            <FormField name="commission" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Comisión (%)</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" type="number" v-bind="componentField" />
                </FormControl>
              </FormItem>
            </FormField>


            <FormField name="website" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Sitio Web</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
                <p v-if="componentField.errorMessage" class="text-red-600 text-sm mt-1">
                  {{ componentField.errorMessage }}
                </p>
              </FormItem>
            </FormField>
            
            <FormField name="numero_movil" v-slot="{ componentField }">
              <FormItem>
                <FormLabel class="block">Número Móvil</FormLabel>
                <FormControl>
                  <Input class="w-full shadow-none rounded-lg border-gray-200" v-bind="componentField" />
                </FormControl>
              </FormItem>
            </FormField>
            


            <div class="col-span-1 md:col-span-2 lg:col-span-3 mt-3 text-center">
              <Button type="submit" :disabled="guardando" class="bg-skyblue-fincore">
                {{ guardando ? 'Guardando...' : 'Guardar' }}
              </Button>
              
              <Button v-if="botonSubirReporte" type="button" class="ms-5 bg-skyblue-fincore" @click="router.visit(`/prospectos/prospecto/reporte/${idProspecto}`)">
                {{ guardando ? 'Guardando...' : 'Subir Reporte' }}
              </Button>
              <Button v-if="botonAceptante" type="button" class="ms-5 bg-skyblue-fincore" @click="router.visit(`/prospectos/prospecto/aceptante/${idProspecto}`)">
                {{ guardando ? 'Guardando...' : 'Aceptante' }}
              </Button>
            </div>
          </form>


</template>

<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import { useToast } from 'vue-toast-notification'
import { useForm } from 'vee-validate'
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'
import axios from 'axios'
import { ref, watch } from 'vue'
import {
  FormField, FormItem, FormLabel, FormControl
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import type { ProspectoCeRequest, ProspectoCreateResponse } from '@/types/prospecto'

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import { UploadCloud } from 'lucide-vue-next'

const breadcrumbs = [
  { title: 'Prospecto', href: '/prospecto' },
]
const toast = useToast()

// Estados de carga
const consultandoRuc = ref(false)
const guardando = ref(false)

/*const tipoProducto = ref(
  ['Factoring', 'Confirming']
)
const tipoProductoElegido = ref('')
watch(tipoProductoElegido, (val) => {
  setFieldValue('tipo', val)
})*/
const name = ref('')

const formSchema = toTypedSchema(z.object({
  ce: z.string().optional(), //tony
  tipo: z.string().min(1, 'Requerido'), //tony
  activity_start_date: z.string().optional(),
  sales_executive: z.string().min(1, 'Requerido'),
  nombre: z.string().optional(), //tony
  address: z.string().min(1, 'Requerido'),
  fecha_nacimiento: z.string().optional(), //tony
  sexo: z.string().optional(), //tony
  estado_civil: z.string().optional(), //tony
  expected_rate: z.coerce.number().optional(),
  commission: z.coerce.number().optional(),
  email: z.string().email('Correo inválido').optional().or(z.literal('')),
  numero_movil: z.string().optional(), //tony
}))

const { handleSubmit, resetForm, values, setFieldValue, setFieldError } = useForm<ProspectoCeRequest>({
  validationSchema: formSchema,
  initialValues: {
    ce: '123456789acbasdfa', //tony
    tipo: 'Factoring', //tony
    activity_start_date: '',
    sales_executive: '',
    nombre: '', //tony
    address: '',
    fecha_nacimiento: '', //tony
    sexo: '', //tony
    estado_civil: '', //tony
    expected_rate: '',
    commission: '',
    email: '',
    numero_movil: '', //tony
  }
})

const consultarRuc = async () => {
  if (!values.ruc || values.ruc.length !== 11) {
    toast.error('El RUC debe tener 11 dígitos')
    return
  }

  if (!/^\d{11}$/.test(values.ruc)) {
    toast.error('El RUC debe contener solo números')
    return
  }

  consultandoRuc.value = true

  try {
    const { data } = await axios.get(`/api/consultas/ruc/${values.ruc}`)

    if (!data || Object.keys(data).length === 0) {
      toast.error('RUC no encontrado o no existe')
      return
    }

    if (data.estado && data.estado.toLowerCase() === 'inactivo') {
      toast.warning('El RUC está inactivo')
    }

    if (!data.razonSocial && !data.tipo && !data.direccion) {
      toast.error('No se encontró información para este RUC')
      return
    }

    if (data.razonSocial) {
      setFieldValue('business_name', data.razonSocial)
    }
    if (data.tipo) {
      setFieldValue('trade_name', data.tipo)
    }
    if (data.direccion) {
      setFieldValue('address', data.direccion)
    }
    if (data.actividadEconomica) {
      setFieldValue('economic_activity', data.actividadEconomica)
    }
    if (data.inicioActividades) {
      setFieldValue('activity_start_date', data.inicioActividades)
    }

    toast.success('Datos del RUC cargados correctamente')
  } catch (err: any) {
    console.error('Error al consultar RUC:', err)

    if (err?.response?.status === 404) {
      toast.error('RUC no encontrado')
    } else if (err?.response?.status === 429) {
      toast.error('Demasiadas consultas. Intente más tarde')
    } else if (err?.response?.status === 500) {
      toast.error('Error del servidor. Intente más tarde')
    } else if (err?.code === 'NETWORK_ERROR' || !navigator.onLine) {
      toast.error('Error de conexión. Verifique su internet')
    } else {
      toast.error(err?.response?.data?.message || 'Error al consultar el RUC')
    }
  } finally {
    consultandoRuc.value = false
  }
}

const consultarDni = async () => {
  
  if (!values.dni || values.dni.length !== 8) {
    toast.error('El DNI debe tener 8 dígitos')
    return
  }

  if (!/^\d{8}$/.test(values.dni)) {
    toast.error('El DNI debe contener solo números')
    return
  }
  consultandoDni.value = true
  try {
    
    const { data } = await axios.get(`/api/consultas/consultar-dni/${values.dni}`)

    

    if (!data || Object.keys(data).length === 0) {
      toast.error('DNI no encontrado o no existe')
      return
    }

    if (data.estado && data.estado.toLowerCase() === 'inactivo') {
      toast.warning('El DNI está inactivo')
    }

    /*if (!data.razonSocial && !data.tipo && !data.direccion) {
      toast.error('No se encontró información para este DNI')
      return
    }*/
    if (data.data.direccion) {
      setFieldValue('nombre',`${data.data.nombres} ${data.data.apellido_materno} ${data.data.apellido_paterno}`)
    }
    if (data.data.direccion) {
      setFieldValue('address', data.data.direccion)
    }
    console.log(data.data)
    if (data.data.fecha_nacimiento) {
      const [dia, mes, anio] = data.data.fecha_nacimiento.split('/');
      if (dia && mes && anio) {
      const fecha = new Date(`${anio}-${mes}-${dia}`);
      if (!isNaN(fecha.getTime())) {
          const fechaNacimiento = fecha.toISOString().split('T')[0];
          setFieldValue('fecha_nacimiento', fechaNacimiento);
        } else {
          console.warn('Fecha inválida:', data.data.fecha_nacimiento);
          setFieldValue('fecha_nacimiento', '');
        }
      } else {
        console.warn('Formato de fecha incorrecto:', data.data.fecha_nacimiento);
        setFieldValue('fecha_nacimiento', '');
      }
    }
    if (data.data.sexo) {
      setFieldValue('sexo', data.data.sexo)
    }
    if (data.data.estado_civil) {
      setFieldValue('estado_civil', data.data.estado_civil)
    }

    toast.success('Datos del DNI cargados correctamente')
  } catch (err: any) {
    console.error('Error al consultar DNI:', err)

    if (err?.response?.status === 404) {
      toast.error('DNI no encontrado')
    } else if (err?.response?.status === 429) {
      toast.error('Demasiadas consultas. Intente más tarde')
    } else if (err?.response?.status === 500) {
      toast.error('Error del servidor. Intente más tarde')
    } else if (err?.code === 'NETWORK_ERROR' || !navigator.onLine) {
      toast.error('Error de conexión. Verifique su internet')
    } else {
      toast.error(err?.response?.data?.message || 'Error al consultar el DNI')
    }
  } finally {
    consultandoDni.value = false
  }
}

const idProspecto = ref(0)
const botonSubirReporte = ref(false)
const botonAceptante = ref(false)

const guardarProspecto = handleSubmit(async (formData) => {
  guardando.value = true

  try {
    const res = await axios.post<ProspectoCreateResponse>('/api/prospecto/guardar_ce', formData)

    if (res.status === 200 || res.status === 201) {
      toast.success(res.data.message || 'Prospecto guardado exitosamente')
      idProspecto.value = res.data.id
      botonSubirReporte.value = true
    }
  } catch (err: any) {
    console.error('Error al guardar prospecto:', err)

    if (err?.response?.status === 422) {
      if (err?.response?.data?.errors) {
        const errors = err.response.data.errors

        Object.keys(errors).forEach(field => {
          const errorMessage = Array.isArray(errors[field]) ? errors[field][0] : errors[field]
          setFieldError(field, errorMessage)
        })

        toast.error('Por favor corrija los errores en el formulario')
      } else {
        toast.error('Datos inválidos. Verifique la información')
      }
    }
    else if (err?.response?.status === 409) {
      toast.error('El prospecto ya existe en el sistema')
    }
    else if (err?.response?.status === 500) {
      toast.error('Error del servidor. Intente más tarde')
    }
    else if (err?.code === 'NETWORK_ERROR' || !navigator.onLine) {
      toast.error('Error de conexión. Verifique su internet')
    }
    else if (err?.code === 'TIMEOUT') {
      toast.error('La operación tomó demasiado tiempo. Intente de nuevo')
    }
    else {
      toast.error(err?.response?.data?.message || 'Error al guardar el prospecto')
    }
  } finally {
    guardando.value = false
  }
})
</script>