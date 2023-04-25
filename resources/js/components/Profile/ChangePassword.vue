<template>
    <Panel header="Maīnit Paroli" v-if="!changedSuccesfully">
        <Message severity="warn" :closable="false">
            <div class="ml-2">
                <ul class="flex flex-column gap-2">
                    <li>Vecā parole un jaunā nedrīkst būt vienādas</li>
                    <li>Jaunajām parolēm jāsakrīt</li>
                    <li>Parolei ir jābūt vismaz 8 rakstzīmju garai</li>
                </ul>
            </div>
        </Message>
        <Divider/>
        <div class="input-fields-container">
            <Password v-model="oldPassword" :feedback="false" toggleMask placeholder="Vecā parole"/>
                <Divider/>
            <Password v-model="newPassword" :feedback="false" toggleMask placeholder="Jaunā parole"/>
                <Divider/>
            <Password v-model="confirmNewPassword" :feedback="false" toggleMask placeholder="Jaunā parole atkārtoti"/>
                <Divider/>
            <div class="flex flex-wrap gap-4">
                <Button type="submit" :loading="isLoading" @click="submitForm" label="Mainīt paroli"/>
                <InlineMessage v-if="errorMessage">{{ errorMessage }}</InlineMessage>
            </div>
        </div>
    </Panel>
    <div v-if="changedSuccesfully">
        <Message severity="success" :closable="false">Parole nomainīta veiksmīgi</Message>
    </div>
</template>
<script setup>
import {computed, ref} from 'vue';
import Panel from "primevue/panel";
import Button from "primevue/button";
import Password from "primevue/password";
import Divider from "primevue/divider";
import {useProfileStore} from "../../store/user";
import Message from "primevue/message";
import InlineMessage from "primevue/inlinemessage";
import Fieldset from "primevue/fieldset";


const profileStore = useProfileStore()
const oldPassword = ref('');
const newPassword = ref('');
const confirmNewPassword = ref('');
const user = computed(() => profileStore.getUser)
const changedSuccesfully = ref(false)
const errorMessage = ref()
const isLoading = computed(() => profileStore.getLoadingChangePassword)

const submitForm = () => {
    if (!oldPassword.value || !newPassword.value || !confirmNewPassword.value) {
        errorMessage.value = 'Lūdzu aizpildiet visus laukus';
        return;
    }

    if (newPassword.value !== confirmNewPassword.value) {
        errorMessage.value = 'Lūdzu pārbaudiet paroli un mēginiet vēlreiz';
        return;
    }

    errorMessage.value = ''
    changePassword();
};
const changePassword = async () => {
    const payload = {
        current_password: oldPassword.value,
        new_password: newPassword.value,
        new_password_confirmation: confirmNewPassword.value
    }
    const response = await profileStore.changeUserPassword(user.value.id, payload)

    if (response === 200) {
        changedSuccesfully.value = true
    } else {
        errorMessage.value = 'Lūdzu pārbaudiet paroli un mēginiet vēlreiz'
    }
}
</script>

<style lang="scss">
.p-fieldset-legend {
    margin-left: 20px !important;
}

.p-password {
    svg {
        right: 15px !important;
    }
}
</style>
