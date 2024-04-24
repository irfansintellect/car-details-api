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

import { usePage } from "@inertiajs/vue3";
const generalSetting = usePage().props.generalSetting;

const form = useForm({
    companyName: props.setting.company_name,
    logo_black: null,
    logo_white: null,
    companyEmail: props.setting.company_email,
    companyPhone: props.setting.company_phone,
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
                                Update Setting
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
                                <InputLabel for="name" value="Site Name" />
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

                            <div class="flex justify-start gap-2">
                                <div>
                                    <InputLabel
                                        for="email"
                                        value="Company Email"
                                    />
                                    <TextInput
                                        id="email"
                                        v-model="form.companyEmail"
                                        type="email"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.companyEmail"
                                    />
                                </div>
                                <div>
                                    <InputLabel
                                        for="phone"
                                        value="Company Phone"
                                    />
                                    <TextInput
                                        id="phone"
                                        v-model="form.companyPhone"
                                        type="tel"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.companyPhone"
                                    />
                                </div>
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
                            <div class="p-5 bg-gray-700">
                                <img
                                    :src="generalSetting.logo_white"
                                    class="h-20"
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

                            <div class="p-5">
                                <img
                                    :src="generalSetting.logo_black"
                                    class="h-20"
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
