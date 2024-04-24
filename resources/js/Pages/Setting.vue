<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    setting: Object,
});
const form = useForm({
    companyName: props.setting.company_name,
    logo_black: null,
    logo_white: null,
});

function submitSetting() {
    form.post(route("settings.update"), {
        onSuccess: (res) => {
            location.reload();
        },
    });
}
</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative">
                <div
                    class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Update Seting
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Update your account's setting information.
                            </p>
                        </header>
                        <form
                            class="mt-6 space-y-6"
                            enctype="multipart/form-data"
                            @submit.prevent="submitSetting"
                        >
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    v-model="form.companyName"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.companyName"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="logo_white"
                                    value="Logo White"
                                />
                                <TextInput
                                    id="logo_white"
                                    type="file"
                                    @input="
                                        form.logo_white = $event.target.files[0]
                                    "
                                    class="mt-1 block w-full"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.logo_white"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="logo_black"
                                    value="Logo Black"
                                />
                                <TextInput
                                    id="logo_black"
                                    type="file"
                                    @input="
                                        form.logo_black = $event.target.files[0]
                                    "
                                    class="mt-1 block w-full"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.logo_black"
                                />
                            </div>

                            <div></div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton> Update </PrimaryButton>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
