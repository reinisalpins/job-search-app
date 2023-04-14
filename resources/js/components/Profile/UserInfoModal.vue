<template>
    <Button label="Profila informācija" @click="showModal"/>
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
            <Button :loading="loading" label="Saglabāt" @click="submitProfile"/>
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
import { useToast } from "primevue/usetoast";
const toast = useToast();

const store = useStore();

const user = computed(() => store.state.user);
const profileInfo = computed(() => store.state.profile.userProfileInfo);
const selectedSkills = ref();
const loading = ref(false)

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
    await getProfileInfo();
}

const getProfileInfo = async () => {
    await store.dispatch('profile/fetchProfileInfo', user.value.id);
    setSelectedValues();
}

const visible = ref(false);

const submitProfile = async () => {
    const payload = {
        user_id: user.value.id,
        skills: selectedSkills.value.map(skill => skill.name),
        experience: selectedExperience.value.name,
        education: selectedEducation.value.name,
        location: selectedLocation.value,
    };

    loading.value = true

    try {
        if (profileInfo.value) {
            await store.dispatch('profile/updateProfileInfo', {userId: user.value.id, payload});
        } else {
            await store.dispatch('profile/createProfileInfo', {userId: user.value.id, payload});
        }
    } catch (error) {
        console.error(error);
        toast.add({ severity: 'error', summary: 'Kļūda', detail: 'Nevarēja saglabāt profilu', life: 3000 });
    } finally {
        toast.add({ severity: 'success', summary: 'Profils', detail: 'Profila informācija saglabāta veiksmīgi', life: 3000 });
        loading.value = false
    }
};

const setSelectedValues = () => {
    if (profileInfo.value) {
        selectedSkills.value = itSkills.value.filter(skill => profileInfo.value.skills.includes(skill.name));
        selectedExperience.value = experience.value.find(exp => exp.name === profileInfo.value.experience);
        selectedEducation.value = education.value.find(edu => edu.name === profileInfo.value.education);
        selectedLocation.value = profileInfo.value.location;
    }
};

</script>
<style lang="scss">
.input-form-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>
