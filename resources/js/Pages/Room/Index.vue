<script setup lang="ts">
import { PropType } from "vue";
import App from "@/Layouts/App.vue";
import { Link} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import axios from "axios";
type RoomType={ 
    room_id:String,
        name:String,
        description:String,
        capacity:Number,
        status:String,
        user_id:Number,

}
defineProps( {
    rooms:{
        type: Object as PropType<RoomType[]>,
        required:true,
    },
    errors:Object as PropType<Record<string,string[]>>,
});


const form=ref({
        name:'',
        description:'',
        capacity:'0',
        status:'active',

    });

    const message=ref('');

    const update=()=>{
        console.log(form.value);
    };
const openModal=ref(false);
const roomEdit=ref();
const edit=(roomId:String)=>{
  
    axios.get("/room/edit/"+roomId).then((res)=>
    {
       form.value.name=res.data.name;
       form.value.description=res.data.description;
       form.value.capacity=res.data.capacity;
       form.value.status=res.data.status;
       openModal.value=true;
    })
    .catch((err)=>{
        console.log(err);
    })
    .finally(()=>console.log("finally"));
       
}
</script>

<template>

    <Modal
    :show="openModal" @close="openModal=false">
        <div class="p-4">
           <h2 class="text-xl">Room</h2>
           <div>
            <form @submit.prevent="update" class="flex flex-col  gap-4 mt-4">
         
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
            <button @click="openModal=false" type="button" class="btn btn-error mr-2">Cancel</button>
             <button class="p-2 bg-blue-600 rounded-lg text-white active:bg-blue-800 shadow-2xl" type="submit">Update</button>
         </div>
     </form>
           </div>
        </div>
    </Modal>

    <App>
       
        <div class="p-4">
            <h2 class="text-2xl font-bold">Room List</h2>
            <div class="my-2">
                <Link
                    href="/room/create" 
                    class="bg-blue-600 rounded-md text-white p-2">Add Room</Link>
            </div>
            <div class="p-2 bg-white rounded-lg  dark:bg-slate-800">
                <table class="table-auto w-full text-center">
                    <thead>
                        <tr>
                            <th class="border-blue-600 border bg-blue-100 dark:bg-blue-700">No</th>
                            <th class="border-blue-600 border bg-blue-100 dark:bg-blue-700">Room Name</th>
                            <th class="border-blue-600 border bg-blue-100 dark:bg-blue-700">Status</th>
                            <th class="border-blue-600 border bg-blue-100 dark:bg-blue-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="(room,index) in rooms"
                        >
                            <td class="border border-blue-600">{{ index+1 }}</td>
                            <td class="border border-blue-600">{{ room.name }}</td>
                            <td class="border border-blue-600">{{ room.status.toUpperCase() }}</td>
                            <td class="border border-blue-600 p-1">
                                <button @click="edit(room.room_id)" class="bg-green-600 rounded-md text-white p-2 mr-1">Edit</button>
                                <button class="bg-red-600 rounded-md text-white p-2">Delete</button>
                            </td>
                        </tr>
                       
                    </tbody>
                    
                </table>
            </div>
        </div>
    </App>


</template>