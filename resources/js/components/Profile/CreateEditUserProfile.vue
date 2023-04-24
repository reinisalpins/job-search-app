<template>
    <Panel class="panel-style" header="Iestatīt/labot profila informāciju">
        <div class="input-form-container" v-if="!successEdited">
            <MultiSelect v-model="selectedSkills" name="skills" :options="itSkills" filter optionLabel="name"
                         placeholder="Tavas prasmes"
                         :maxSelectedLabels="3" class="w-full md:w-20rem"/>
            <Divider/>
            <h3 class="pb-2">Tava pieredze: </h3>
            <Listbox v-model="selectedExperience" :options="experience" optionLabel="name"/>
            <Divider/>
            <h3 class="pb-2">Tava izglītība: </h3>
            <Listbox v-model="selectedEducation" :options="education" optionLabel="name"/>
            <Divider/>
            <MultiSelect v-model="selectedLanguages" name="languages" :options="languages" filter optionLabel="name"
                         placeholder="Tavas valodu prasmes"
                         :maxSelectedLabels="3" class="w-full md:w-20rem"/>
            <Divider/>
            <InputText type="text" v-model="selectedLocation" placeholder="Atrašanās vieta"/>
            <Divider/>
            <div class="flex flex-wrap gap-4">
                <Button type="submit" :loading="loading" @click="submitUserProfile" label="Saglabāt"/>
                <InlineMessage v-if="errorMessage">{{ errorMessage }}</InlineMessage>
            </div>
        </div>

        <div v-if="successEdited">
            <Message severity="success" :closable="false">Profila informācija saglabāta veiksmīgi, apskatīt <span
                class="cursor-pointer font-bold hover:underline" @click="closeForm">šeit</span></Message>
        </div>
    </Panel>
</template>

<script setup>
import Panel from "primevue/panel";
import {useProfileStore} from "../../store/user";
import InputText from "primevue/inputtext";
import Listbox from "primevue/listbox";
import MultiSelect from "primevue/multiselect";
import Button from "primevue/button";
import {computed, onMounted, ref} from "vue";
import Divider from "primevue/divider";
import InlineMessage from "primevue/inlinemessage";
import Message from "primevue/message";

const profileStore = useProfileStore()
const user = computed(() => profileStore.getUser)
const successEdited = ref(false)

const props = defineProps({
    profileInfo: Object,
    isProfileInfoSet: Boolean
})

const loading = ref(false)

const selectedLocation = ref()
const errorMessage = ref()

onMounted(() => {
    setSelectedValues()
})

const emits = defineEmits(['close']);

const closeForm = () => {
    emits('close');
};

const selectedSkills = ref()
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

const selectedLanguages = ref()
const languages = ref([
    {name: 'Angļu'},
    {name: 'Latviešu'},
    {name: 'Spāņu'},
    {name: 'Franču'},
    {name: 'Vācu'},
    {name: 'Ķīniešu'},
    {name: 'Japāņu'},
    {name: 'Korejiešu'},
    {name: 'Itāļu'},
    {name: 'Portugāļu'},
    {name: 'Krievu'},
    {name: 'Arābu'},
    {name: 'Hindi'},
])

const setSelectedValues = () => {
    if (props.profileInfo) {
        selectedSkills.value = itSkills.value.filter(skill => props.profileInfo.skills.includes(skill.name));
        selectedExperience.value = experience.value.find(exp => exp.name === props.profileInfo.experience);
        selectedEducation.value = education.value.find(edu => edu.name === props.profileInfo.education);
        selectedLanguages.value = languages.value.filter(language => props.profileInfo.languages.includes(language.name))
        selectedLocation.value = props.profileInfo.location;
    }
}

const submitUserProfile = async () => {
    loading.value = true
    const payload = {
        user_id: user.value?.id,
        skills: selectedSkills.value?.map(skill => skill.name) || [],
        experience: selectedExperience.value?.name || "",
        education: selectedEducation.value?.name || "",
        languages: selectedLanguages.value?.map(language => language.name) || [],
        location: selectedLocation.value || "",
    };

    const isPayloadEmpty = Object.values(payload).some(value => {
        if (Array.isArray(value)) {
            return value.length === 0;
        }
        return !value;
    });

    if (!isPayloadEmpty) {
        if (props.isProfileInfoSet) {
            await profileStore.updateUserProfile(user.value.id, payload)
        } else {
            await profileStore.createUserProfile(user.value.id, payload)
        }
        successEdited.value = true
    } else {
        errorMessage.value = 'Lūdzu aizpildiet visus laukus'
    }
    loading.value = false
}


</script>

<style lang="scss"></style>
