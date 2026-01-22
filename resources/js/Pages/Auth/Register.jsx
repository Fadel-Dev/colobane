import { Head, Link, useForm } from '@inertiajs/react';
import { Button, TextInput, PasswordInput, Text, Title, Container, Stack, Box } from '@mantine/core';
import { useToggle } from '@mantine/hooks';

export default function Register() {
    const [type, toggle] = useToggle(['register', 'login']);
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        phone: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('register'));
    };

    return (
        <Container size={420} my={40}>
            <Head title="Créer un compte" />

            <Title align="center" sx={{ fontWeight: 900 }}>
                Créer un compte
            </Title>
            
            <Text color="dimmed" size="sm" align="center" mt={5}>
                Vous avez déjà un compte ?{' '}
                <Link href={route('login')} className="text-sm text-gray-600 underline hover:text-gray-900">
                    Se connecter
                </Link>
            </Text>

            <Box component="form" onSubmit={submit} mt={30}>
                <Stack>
                    <TextInput
                        label="Nom complet"
                        placeholder="Votre nom complet"
                        required
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        error={errors.name}
                    />

                    <TextInput
                        label="Email"
                        placeholder="votre@email.com"
                        required
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        error={errors.email}
                    />

                    <TextInput
                        label="Téléphone"
                        placeholder="Votre numéro de téléphone"
                        required
                        value={data.phone}
                        onChange={(e) => setData('phone', e.target.value)}
                        error={errors.phone}
                    />

                    <PasswordInput
                        label="Mot de passe"
                        placeholder="Votre mot de passe"
                        required
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        error={errors.password}
                    />

                    <PasswordInput
                        label="Confirmer le mot de passe"
                        placeholder="Confirmez votre mot de passe"
                        required
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        error={errors.password_confirmation}
                    />

                    <Button type="submit" loading={processing} fullWidth mt="xl">
                        S'inscrire
                    </Button>
                </Stack>
            </Box>
        </Container>
    );
}
