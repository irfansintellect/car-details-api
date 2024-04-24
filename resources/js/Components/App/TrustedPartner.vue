<script setup>
defineProps({
    name: String,
});
</script>

<template>
    <section class="py-4 sm:py-24">
        <div class="container mx-auto px-4 space-y-0">
            <div class="flex flex-wrap items-center">
                <div class="py-4 w-full lg:w-6/12">
                    <img
                        src="https://images.unsplash.com/photo-1493238792000-8113da705763?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDJ8fGNhcnxlbnwwfHx8fDE2MzE2NzIwOTU&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=1000&h=650&fit=crop"
                        width="1000"
                        alt="..."
                        height="650"
                    />
                </div>
                <div class="py-4 w-full lg:w-6/12">
                    <div
                        class="bg-white lg:-ml-12 lg:pl-12 lg:py-0 xl:py-12 md:border-0 lg:border pr-5"
                    >
                        <h4
                            class="pt-5 mb-5 capitalize font-bold text-3xl text-gray-900 xl:text-3xl"
                        >
                            Your Trusted Partner for Personal Contract Purchase
                            Compensation!
                        </h4>
                        <p class="mb-5">
                            Navigating through financial agreements can be
                            daunting, especially when you realize you've been
                            misled or sold an unsuitable finance agreement.
                            That's where {{ name }} comes in – we're here to
                            guide you through the claims process with ease and
                            transparency.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
