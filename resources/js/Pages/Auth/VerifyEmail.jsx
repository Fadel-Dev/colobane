import { Head, useForm } from '@inertiajs/react';
import { Button, TextInput, Card, Title, Text, Container } from '@mantine/core';
import { useCallback, useEffect, useState } from 'react';

export default function VerifyEmail({ status, email }) {
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [countdown, setCountdown] = useState(0);
    
    const { data, setData, post, processing, errors } = useForm({
        code: '',
        email: email || ''
    });

    const submit = (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        post(route('verification.verify'), {
            onFinish: () => {
                setIsSubmitting(false);
            },
        });
    };

    const resendVerification = useCallback(() => {
        setCountdown(60); // 60 secondes avant de pouvoir renvoyer
        post(route('verification.send'));
    }, [post]);

    // Gestion du compte à rebours
    useEffect(() => {
        if (countdown > 0) {
            const timer = setTimeout(() => setCountdown(countdown - 1), 1000);
            return () => clearTimeout(timer);
        }
    }, [countdown]);

    return (
        <Container size={420} my={40}>
            <Head title="Vérification d'email" />
            
            <Title align="center" sx={{ fontWeight: 900 }}>
                Vérification d'email
            </Title>
            
            <Text color="dimmed" size="sm" align="center" mt={5}>
                Un code de vérification a été envoyé à votre adresse email
            </Text>

            <Card withBorder shadow="md" p={30} mt={30} radius="md">
                <form onSubmit={submit}>
                    <TextInput
                        label="Code de vérification"
                        placeholder="Entrez le code à 6 chiffres"
                        required
                        maxLength={6}
                        value={data.code}
                        onChange={(e) => setData('code', e.target.value)}
                        error={errors.code}
                        disabled={processing}
                    />

                    <Button 
                        type="submit" 
                        fullWidth 
                        mt="xl"
                        loading={isSubmitting}
                        disabled={!data.code || data.code.length !== 6}
                    >
                        Vérifier l'email
                    </Button>
                </form>

                <div className="mt-4 text-center">
                    <Text size="sm" color="dimmed">
                        Vous n'avez pas reçu de code ?
                    </Text>
                    <Button 
                        variant="subtle" 
                        size="sm" 
                        onClick={resendVerification}
                        disabled={countdown > 0}
                    >
                        {countdown > 0 
                            ? `Renvoyer (${countdown}s)` 
                            : 'Renvoyer le code'}
                    </Button>
                </div>

                {status && (
                    <div className="mt-4 text-sm text-green-600">
                        {status}
                    </div>
                )}
            </Card>
        </Container>
    );
}
