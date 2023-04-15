<template>
    <button @click="showModal" class="submit-btn modal-btn">{{ buttonLabel }}</button>
    <Dialog v-model:visible="visible" :draggable="false" modal header="Profila informācija" :style="{ width: '50vw' }"
            :breakpoints="{ '960px': '75vw', '641px': '90vw' }">
        <div class="input-form-container">
            <MultiSelect v-model="selectedSkills" name="skills" :options="itSkills" filter optionLabel="name"
                         placeholder="Tavas prasmes"
                         :maxSelectedLabels="3" class="w-full md:w-20rem"/>
            <h3 style="padding-top: 20px">Tava pieredze: </h3>
            <Listbox v-model="selectedExperience" :options="experience" optionLabel="name"/>
            <h3 style="padding-top: 20px">Tava izglītība: </h3>
            <Listbox v-model="selectedEducation" :options="education" optionLabel="name"/>
            <h3 style="padding-top: 20px">Tava atrašanās vieta: </h3>
            <InputText type="text" v-model="selectedLocation" placeholder="Atrašanās vieta"/>
            <span></span>
            <Button :loading="loading" label="Saglabāt" class="submit-btn modal-btn" @click="submitProfile"/>
        </div>
    </Dialog>
</template>
<script setup>
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import {computed, ref} from "vue";
import {useStore} from "vuex";
import InputText from "primevue/inputtext";
import MultiSelect from "primevue/multiselect";
import Listbox from "primevue/listbox";
import {useToast} from "primevue/usetoast";

const toast = useToast();
const store = useStore();
const selectedSkills = ref();
const loading = ref(false)

const props = defineProps({
    isProfileInfoSet: {
        type: Boolean,
        required: true
    },
    profileInfo: Object
})

const buttonLabel = computed(() => {
    return props.isProfileInfoSet ? 'Labot profila informāciju' : 'Iestatīt profila informāciju';
});

const selectedLocation = ref()
const itSkills = ref([
    {name: 'Java'},
    {name: 'Python'},
    {name: 'JavaScript'},
    {name: 'C#'},
    {name: 'SQL'},
    {name: 'React'},
    {name: 'Node.js'},
    {name: 'HTML'},
    {name: 'CSS'},
    {name: 'Angular'},
    {name: 'Vue.js'},
    {name: 'PHP'},
    {name: 'Swift'},
    {name: 'Kotlin'},
    {name: 'Ruby'},
    {name: 'C++'},
    {name: 'Git'},
    {name: 'Jira'},
    {name: 'AWS'},
    {name: 'Docker'},
    {name: 'Kubernetes'},
    {name: 'Agile Methodologies'},
    {name: 'Scrum'},
    {name: 'CI/CD'},
    {name: 'Bash Scripting'},
    {name: 'Linux Administration'},
    {name: 'Networking'},
    {name: 'DevOps'},
    {name: 'Data Analysis'},
    {name: 'Machine Learning'},
    {name: 'Big Data'},
    {name: 'Blockchain'},
    {name: 'Artificial Intelligence'},
    {name: 'Cybersecurity'},
    {name: 'Cloud Computing'},
    {name: 'Mobile App Development'},
    {name: 'UI/UX Design'},
    {name: 'Testing and Quality Assurance'},
    {name: 'Project Management'},
    {name: 'Technical Writing'},
    {name: 'Version Control'},
    {name: 'Database Administration'},
    {name: 'Virtualization'},
    {name: 'Web Development'},
    {name: 'Adobe Photoshop'},
    {name: 'Adobe Illustrator'},
    {name: 'Adobe InDesign'},
    {name: 'Sketch'},
    {name: 'Figma'},
    {name: 'Canva'},
    {name: 'CorelDRAW'}
]);

const selectedExperience = ref();
const experience = ref([
    {name: '0-1 gads'},
    {name: '1-2 gadi'},
    {name: '3-5 gadi'},
    {name: '5+ gadi'},
]);


const selectedEducation = ref();
const education = ref([
    {name: 'Pamatizglītība'},
    {name: 'Vidējā izglītība'},
    {name: 'Augstākā izglītība'},
]);

const showModal = async () => {
    visible.value = true;
    if (props.isProfileInfoSet) {
        setSelectedValues();
    }
}

const visible = ref(false);

const submitProfile = async () => {
    const payload = {
        user_id: store.state.user.id,
        skills: selectedSkills.value.map(skill => skill.name),
        experience: selectedExperience.value.name,
        education: selectedEducation.value.name,
        location: selectedLocation.value,
    };

    loading.value = true

    try {
        if (props.profileInfo) {
            await store.dispatch('profile/updateProfileInfo', {userId: store.state.user.id, payload});
        } else {
            await store.dispatch('profile/createProfileInfo', {userId: store.state.user.id, payload});
        }
    } catch (error) {
        console.error(error);
        toast.add({severity: 'error', summary: 'Kļūda', detail: 'Nevarēja saglabāt profilu', life: 3000});
    } finally {
        toast.add({
            severity: 'success',
            summary: 'Profils',
            detail: 'Profila informācija saglabāta veiksmīgi',
            life: 3000
        });
        loading.value = false
    }
};

const setSelectedValues = () => {
    if (props.profileInfo) {
        selectedSkills.value = itSkills.value.filter(skill => props.profileInfo.skills.includes(skill.name));
        selectedExperience.value = experience.value.find(exp => exp.name === props.profileInfo.experience);
        selectedEducation.value = education.value.find(edu => edu.name === props.profileInfo.education);
        selectedLocation.value = props.profileInfo.location;
    }
};

defineExpose({
    showModal
});
</script>

<style lang="scss">
.input-form-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.modal-btn {
    margin-top: 10px;
    padding: 15px;
    border-radius: 3px !important;
    width: 100%;
    font-weight: bold;
}
</style>
