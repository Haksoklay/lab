<script setup>
import { ref } from 'vue';
import { router,Link } from '@inertiajs/vue3';
import Layout from "@/Layouts/App.vue";



    const props=defineProps({
        errors:Object,
    })
    // const roomName=ref()
    // const description =ref()
    // const capacity=ref()
    // const status =ref('active')

    const form=ref({
        name:'',
        description:'',
        capacity:'0',
        status:'active',

    })

    const message=ref('')

    const save=()=>{
        // const data={
        //     roomName:roomName.value,
        //     description:description.value,
        //     capacity:capacity.value,
        //     status:status.value
        // }
        router.post('/room/store',form.value,{
            onSuccess:()=>{
                // message.value='Room create successfully'
                // roomName.value=''
                // description.value=''
                // capacity.value=''
                // status.value='Active'

                form.value={
                    name:'',
                    description:'',
                    capacity:'0',
                    status:'active',
                };
                message.value='Room create successfully'

            }
        })

    }


</script>

<template>
    
   <Layout>
    <div class="p-4">
        <div class="my-2">
                <Link
                    href="/room/" 
                    class="bg-yellow-600 rounded-md text-white p-2">Back</Link>
        </div>
        <h2 class="text-2xl text-blue-600 sm:text-red-600 md:text-yellow-600 lg:text-purple-600">Create Room</h2>
       <div class="text-green-600">
        {{ message }}
       </div>
        <form @submit.prevent="save" class="flex flex-col  gap-4 mt-4">
         
            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Room name</label>
                    <input v-model.trim="form.name" type="text" class="p-2 rounded-md dark:bg-slate-400" />
                    <div v-if="errors.name" class="text-red-500 text-sm">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <label>Description</label>
                    <textarea v-model="form.description" class="rounded-md dark:bg-slate-400"></textarea>
                   
                </div>
            </div>

            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Capacity</label>
                    <input v-model.number="form.capacity" class="rounded-md dark:bg-slate-400" type="number"/>
                    <div v-if="errors.capacity" class="text-red-500 text-sm">
                        {{ errors.capacity }}
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <label>Status</label>
                    <select v-model="form.status" class="rounded-md dark:bg-slate-400">
                        <option value="">Select a Status</option>
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <div v-if="errors.status" class="text-red-500 text-sm">
                        {{ errors.status }}
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="p-2 bg-blue-600 rounded-lg text-white active:bg-blue-800 shadow-2xl" type="submit">Create</button>
            </div>
        </form>
    </div>
    </Layout>
</template>

