<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
const memberStatus = computed(() => page.props.auth.member_status);

const applyMemberForm = useForm({});

const applyMember = () => {
    applyMemberForm.post(route('member.apply'), {
        preserveScroll: true
    });
};

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-xl md:text-2xl font-bold text-slate-800 tracking-tight">Pengaturan Profil</h1>
            <p class="text-xs md:text-sm text-slate-500">Kelola informasi akun dan keamanan Anda</p>
        </template>

        <div class="max-w-7xl mx-auto space-y-8">
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-200 transition-all hover:shadow-md">
                <div class="max-w-xl">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                </div>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-200 transition-all hover:shadow-md">
                <div class="max-w-xl">
                    <UpdatePasswordForm />
                </div>
            </div>

            <div class="bg-rose-50 p-6 md:p-8 rounded-2xl shadow-sm border border-rose-100 transition-all hover:shadow-md">
                <div class="max-w-xl text-rose-800">
                    <DeleteUserForm />
                </div>
            </div>

            <!-- MEMBERSHIP CARD -->
            <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-6 md:p-8 rounded-2xl shadow-sm border border-indigo-100 transition-all hover:shadow-md">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-black text-indigo-900">Program Membership</h2>
                            <p class="mt-1 text-sm text-indigo-600 font-medium">
                                Bergabung menjadi member untuk menikmati berbagai keuntungan eksklusif dan diskon spesial.
                            </p>
                        </header>

                        <div class="mt-6">
                            <div v-if="memberStatus === 'approved'" class="bg-white p-4 rounded-xl border border-emerald-100 flex items-center gap-4">
                                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center font-black text-xl">
                                    ✓
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-800 tracking-tight">Status: Member Aktif</h3>
                                    <p class="text-xs text-slate-500 font-medium mt-0.5">Nikmati diskon di halaman pemesanan.</p>
                                </div>
                            </div>
                            
                            <div v-else-if="memberStatus === 'pending'" class="bg-white p-4 rounded-xl border border-amber-100 flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center font-black text-xl animate-pulse">
                                    ⏳
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-800 tracking-tight">Status: Menunggu Persetujuan</h3>
                                    <p class="text-xs text-slate-500 font-medium mt-0.5">Admin sedang memproses pengajuan Anda.</p>
                                </div>
                            </div>

                            <div v-else>
                                <form @submit.prevent="applyMember" class="space-y-4">
                                    <button 
                                        type="submit" 
                                        :disabled="applyMemberForm.processing"
                                        class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 active:scale-95 disabled:opacity-50"
                                    >
                                        {{ applyMemberForm.processing ? 'Mengirim...' : 'Ajukan Membership Sekarang' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
