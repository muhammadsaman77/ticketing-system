<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger } from '@/components/ui/select';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import { Textarea } from '@/components/ui/textarea';
import { router, usePage } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { computed, onMounted, ref, watch } from 'vue';
import * as z from 'zod';
const props = defineProps({
    status: String,
    id: Number,
});
type Handlers = {
    id: number;
    name: string;
    role: string;
};
const selected = ref('');
const selectedRole = ref('');
const filteredHandlers = ref<Handlers[]>([]);
watch(selectedRole, () => {
    filteredHandlers.value = handlers.filter((handler) => handler.role === selectedRole.value);
});
const isModalOpen = ref(false);
const page = usePage();
const handlers = page.props.handlers as Handlers[];
const errors = computed(() => page.props.errors || {});

const handleChange = () => {
    if (selected.value !== 'IN_PROGRESS') {
        selectedRole.value = '';
    }
};
onMounted(() => {
    selected.value = props.status ?? '';
});

const { handleSubmit } = useForm<FormData>({
    validationSchema: toTypedSchema(
        z
            .object({
                status: z.enum(['OPEN', 'IN_PROGRESS', 'PENDING_USER_ACTION', 'RESOLVED', 'CLOSED', 'CANCELLED']),
                role: z.enum(['PIC', 'HELPDESK']).optional(),
                handler_id: z.number().optional(),
                note: z.string().optional(),
            })
            .superRefine((data, ctx) => {
                if (data.status === 'IN_PROGRESS' && !data.role) {
                    ctx.addIssue({
                        path: ['role'],
                        code: z.ZodIssueCode.custom,
                        message: 'Role is required when status is IN_PROGRESS',
                    });
                }
                if (data.status === 'IN_PROGRESS' && !data.handler_id) {
                    ctx.addIssue({
                        path: ['handler_id'],
                        code: z.ZodIssueCode.custom,
                        message: 'Handler is required when status is IN_PROGRESS',
                    });
                }
            }),
    ),
});

const onSubmit = handleSubmit((values) => {
    router.visit(route('submissions.update', props.id), {
        method: 'put',
        data: values,
        /*************  ✨ Windsurf Command ⭐  *************/
        /**
         * Called when the submission is successfully updated.
         *
         * @param {import('@inertiajs/vue3').PageProps} page - The new page props
         */
        /*******  f78177df-4059-4abc-9c20-d3cc687b5421  *******/
        onSuccess: () => {
            console.log('success');
            console.log(errors);
        },
    });
});
</script>

<template>
    <Dialog v-model:open="isModalOpen">
        <DialogTrigger as-child>
            <Button> Edit </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <form @submit="onSubmit">
                <DialogHeader>
                    <DialogTitle>Edit Submission {{ props.id }}</DialogTitle>
                    <DialogDescription> Make changes to submission data here. Click save when you're done. </DialogDescription>
                </DialogHeader>
                <div class="mt-4 space-y-4">
                    <FormField v-slot="{ componentField }" name="status">
                        <FormItem>
                            <FormLabel>Status</FormLabel>
                            <Select v-model="selected" v-bind="componentField" v-on:update:model-value="handleChange">
                                <SelectTrigger class="w-full">
                                    {{ selected.replaceAll('_', ' ') }}
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem value="OPEN"> OPEN </SelectItem>
                                        <SelectItem value="IN_PROGRESS"> IN PROGRESS </SelectItem>
                                        <SelectItem value="PENDING_USER_ACTION"> PENDING USER ACTION </SelectItem>
                                        <SelectItem value="RESOLVED"> RESOLVED </SelectItem>
                                        <SelectItem value="CLOSED"> CLOSED </SelectItem>
                                        <SelectItem value="CANCELLED"> CANCELLED </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <FormDescription> This is submission status. </FormDescription>
                            <FormMessage />
                            <template v-if="errors?.status">
                                <span class="text-sm text-destructive"> {{ errors.status }} </span>
                            </template>
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="role">
                        <FormItem>
                            <FormLabel>Role Handler</FormLabel>
                            <Select v-bind="componentField" v-model="selectedRole">
                                <FormControl>
                                    <SelectTrigger class="w-full" :disabled="selected !== 'IN_PROGRESS'">
                                        <SelectValue placeholder="Select a role to handler" />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem value="PIC"> PIC </SelectItem>
                                        <SelectItem value="HELPDESK"> HELPDESK </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <FormDescription> This is role of handler. </FormDescription>
                            <FormMessage />
                            <template>
                                <span class="text-sm text-destructive"> {{ errors.role }} </span>
                            </template>
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="handler_id">
                        <FormItem>
                            <FormLabel>Handler</FormLabel>
                            <Select v-bind="componentField">
                                <FormControl>
                                    <SelectTrigger class="w-full" :disabled="selected !== 'IN_PROGRESS'">
                                        <SelectValue placeholder="Select a handler" />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem v-for="handler in filteredHandlers" :key="handler.id" :value="handler.id">{{
                                            handler.name
                                        }}</SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <FormDescription> This is handler of ticket submission. </FormDescription>
                            <FormMessage />
                            <template>
                                <span class="text-sm text-destructive"> {{ errors.handler_id }} </span>
                            </template>
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="note">
                        <FormItem>
                            <FormLabel>Note</FormLabel>
                            <FormControl>
                                <Textarea v-bind="componentField" />
                            </FormControl>
                            <FormDescription> This is submission note changes. </FormDescription>
                            <FormMessage />
                            <!-- <template >
                            <span class="text-sm text-destructive"> {{ errors.name }} </span>
                        </template> -->
                        </FormItem>
                    </FormField>
                </div>
                <DialogFooter>
                    <Button type="submit"> Save changes </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
