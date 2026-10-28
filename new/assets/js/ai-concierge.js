document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('[data-ai-concierge]');
    if (!root) return;

    const launcher = root.querySelector('.ai-concierge__launcher');
    const panel = root.querySelector('.ai-concierge__panel');
    const closeButton = root.querySelector('.ai-concierge__close');
    const restartButton = root.querySelector('.ai-concierge__restart');
    const messages = root.querySelector('.ai-concierge__messages');
    const chatForm = root.querySelector('.ai-concierge__chat-form');
    const input = chatForm.querySelector('textarea');
    const enquiryForm = root.querySelector('.ai-concierge__enquiry');
    const suggestions = root.querySelector('.ai-concierge__suggestions');
    const flowProgress = root.querySelector('.ai-flow-progress');
    const flowProgressStep = flowProgress.querySelector('b');
    const flowProgressBar = flowProgress.querySelector('.ai-flow-progress__track span');
    const history = [];
    const csrfToken = document.querySelector('meta[name="csrf_token"]')?.content || '';
    const transferSteps = [
        { key: 'origin', question: 'Where is the patient travelling from?' },
        { key: 'destination', question: 'What is the destination city or hospital?' },
        { key: 'travel_date', question: 'When is the transfer needed? You can say today, urgent, or provide a date.' },
        {
            key: 'service',
            question: 'Do you have a transport preference?',
            options: ['Not sure', 'Charter air ambulance', 'Commercial stretcher', 'Medical escort', 'Road ambulance', 'Train ambulance'],
        },
        { key: 'patient_needs', question: 'Briefly describe the patient’s mobility or support needs. Please do not share medical records.' },
        { key: 'name', question: 'What is your name?' },
        { key: 'phone', question: 'What phone number should our coordination team call?' },
        { key: 'consent', question: 'May Ashoka Rescue contact you about this transfer request?', options: ['Yes', 'No'] },
    ];
    let transferFlow = null;

    let panelMotion;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const setOpen = (isOpen) => {
        panelMotion?.cancel();
        launcher.setAttribute('aria-expanded', String(isOpen));
        document.body.classList.toggle('ai-concierge-open', isOpen);
        if (isOpen) panel.hidden = false;
        if (!reducedMotion.matches && panel.animate) {
            panelMotion = panel.animate(
                isOpen
                    ? [{ opacity: 0, transform: 'translateY(18px) scale(.98)' }, { opacity: 1, transform: 'none' }]
                    : [{ opacity: 1, transform: 'none' }, { opacity: 0, transform: 'translateY(12px) scale(.98)' }],
                { duration: isOpen ? 240 : 170, easing: 'cubic-bezier(.22,.61,.21,1)' },
            );
            panelMotion.onfinish = () => { if (!isOpen) panel.hidden = true; };
        } else panel.hidden = !isOpen;
        if (isOpen) window.setTimeout(() => input.focus(), 50);
        else launcher.focus();
    };

    root.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !panel.hidden) setOpen(false);
    });

    const showEnquiry = (show) => {
        enquiryForm.hidden = !show;
        messages.hidden = show;
        if (suggestions) suggestions.hidden = show;
        chatForm.hidden = show;
        if (show) enquiryForm.querySelector('input')?.focus();
    };

    const addMessage = (text, role, pending = false) => {
        const bubble = document.createElement('div');
        bubble.className = `ai-message ai-message--${role}${pending ? ' ai-message--pending' : ''}`;
        bubble.style.setProperty('text-align', 'left', 'important');
        bubble.style.setProperty('justify-content', 'flex-start', 'important');
        bubble.style.setProperty('align-items', 'flex-start', 'important');
        const messageText = document.createElement('span');
        messageText.className = 'ai-message__text';
        messageText.textContent = text;
        bubble.appendChild(messageText);
        messages.appendChild(bubble);
        messages.scrollTop = messages.scrollHeight;
        return bubble;
    };

    const renderActions = (actions = []) => {
        if (!actions.length) return;
        const actionList = document.createElement('div');
        actionList.className = 'ai-message-actions';

        actions.forEach((action) => {
            const control = document.createElement(action.url ? 'a' : 'button');
            control.className = 'ai-message-action';
            control.textContent = action.label;

            if (action.url) {
                control.href = action.url;
                if (/^https?:/i.test(action.url)) control.rel = 'noopener';
            } else {
                control.type = 'button';
                control.addEventListener('click', () => {
                    if (action.action === 'transfer') startTransferFlow();
                    if (action.action === 'submit-transfer') submitTransferFlow();
                    if (action.action === 'cancel-transfer') cancelTransferFlow();
                    if (action.action === 'restart') resetConversation();
                    if (action.value) handleTransferAnswer(action.value);
                    if (action.prompt) sendMessage(action.prompt);
                });
            }
            actionList.appendChild(control);
        });

        messages.appendChild(actionList);
        messages.scrollTop = messages.scrollHeight;
    };

    const askTransferQuestion = () => {
        const step = transferSteps[transferFlow.step];
        flowProgress.hidden = false;
        flowProgressStep.textContent = String(transferFlow.step + 1);
        flowProgressBar.style.width = `${((transferFlow.step + 1) / transferSteps.length) * 100}%`;
        addMessage(step.question, 'assistant');
        input.placeholder = `Reply about ${step.key.replace('_', ' ')}…`;
        if (step.options) {
            renderActions(step.options.map((option) => ({ label: option, value: option })));
        }
    };

    const startTransferFlow = () => {
        transferFlow = { step: 0, data: {} };
        input.disabled = false;
        showEnquiry(false);
        setOpen(true);
        addMessage('Let’s prepare the transfer request together. I’ll ask one short question at a time.', 'assistant');
        askTransferQuestion();
    };

    const resetConversation = () => {
        transferFlow = null;
        flowProgress.hidden = true;
        input.disabled = false;
        input.value = '';
        input.placeholder = 'Ask about a service or transfer…';
        messages.innerHTML = '';
        addMessage('Hi, I’m Ashoka AI. I can explain our services, guide a transfer request, or take you to the right page.', 'assistant');
        renderActions([
            { label: 'Show me services', prompt: 'Tell me about your medical transport services' },
            { label: 'I need a transfer', action: 'transfer' },
            { label: 'Compare options', prompt: 'Compare your medical transport options' },
            { label: 'How it works', prompt: 'How does Ashoka Rescue arrange a patient transfer?' },
            { label: 'What does it cost?', prompt: 'How is the price of a patient transfer calculated?' },
        ]);
        input.focus();
    };

    const cancelTransferFlow = () => {
        transferFlow = null;
        flowProgress.hidden = true;
        input.disabled = false;
        input.placeholder = 'Ask about a service or transfer…';
        addMessage('The transfer request was cancelled. Nothing was submitted.', 'assistant');
        renderActions([
            { label: 'Start again', action: 'transfer' },
            { label: 'Explore services', prompt: 'Tell me about your medical transport services' },
        ]);
    };

    const reviewTransferFlow = () => {
        const details = transferFlow.data;
        flowProgressStep.textContent = String(transferSteps.length);
        flowProgressBar.style.width = '100%';
        addMessage(
            `Please review your request:\n\nRoute: ${details.origin} to ${details.destination}\nTiming: ${details.travel_date}\nPreference: ${details.service}\nSupport needs: ${details.patient_needs}\nContact: ${details.name}, ${details.phone}`,
            'assistant',
        );
        input.disabled = true;
        renderActions([
            { label: 'Submit request', action: 'submit-transfer' },
            { label: 'Start over', action: 'transfer' },
            { label: 'Cancel', action: 'cancel-transfer' },
        ]);
    };

    const submitTransferFlow = async () => {
        const pending = addMessage('Sending your transfer brief securely…', 'assistant', true);
        input.disabled = true;

        try {
            const response = await fetch(root.dataset.endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'lead', ...transferFlow.data, consent: '1', email: '', csrf_token: csrfToken }),
            });
            const data = await response.json();
            if (!data.status) throw new Error(data.message || 'Unable to send enquiry.');
            pending.textContent = data.message;
            renderActions([
                { label: 'Explore services', url: `${window.weburl}/services` },
                { label: 'Start another request', action: 'transfer' },
            ]);
        } catch (error) {
            pending.textContent = error.message || 'Unable to send the enquiry. Please call our coordination team.';
        } finally {
            pending.classList.remove('ai-message--pending');
            input.disabled = false;
            input.placeholder = 'Ask about a service or transfer…';
            transferFlow = null;
            flowProgress.hidden = true;
            input.focus();
        }
    };

    const handleTransferAnswer = (answer) => {
        if (!transferFlow) return;
        const cleanAnswer = answer.trim();
        if (!cleanAnswer) return;

        const step = transferSteps[transferFlow.step];
        addMessage(cleanAnswer, 'user');

        if (step.key === 'consent' && cleanAnswer.toLowerCase() !== 'yes') {
            addMessage('No problem. I have not submitted the request. You can continue exploring our services.', 'assistant');
            renderActions([{ label: 'View services', url: `${window.weburl}/services` }]);
            transferFlow = null;
            input.placeholder = 'Ask about a service or transfer…';
            return;
        }

        transferFlow.data[step.key] = cleanAnswer;
        transferFlow.step += 1;

        if (transferFlow.step >= transferSteps.length) {
            reviewTransferFlow();
            return;
        }
        askTransferQuestion();
    };

    const sendMessage = async (text) => {
        const cleanText = text.trim();
        if (!cleanText) return;

        if (transferFlow) {
            input.value = '';
            input.style.height = 'auto';
            handleTransferAnswer(cleanText);
            return;
        }

        addMessage(cleanText, 'user');
        const pending = addMessage('', 'assistant', true);
        pending.classList.add('ai-message--typing');
        pending.setAttribute('aria-label', 'Ashoka AI is thinking');
        pending.innerHTML = '<span></span><span></span><span></span>';
        input.value = '';
        input.style.height = 'auto';

        try {
            const response = await fetch(root.dataset.endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'message',
                    message: cleanText,
                    history: history.slice(-6),
                    csrf_token: csrfToken,
                }),
            });
            const data = await response.json();
            pending.innerHTML = '';
            const responseText = document.createElement('span');
            responseText.className = 'ai-message__text';
            responseText.textContent = data.message || 'Please try again or contact our team.';
            pending.appendChild(responseText);
            pending.classList.remove('ai-message--pending');
            pending.classList.remove('ai-message--typing');
            const responseActions = data.actions || [];
            if (!responseActions.some((action) => action.prompt)) {
                responseActions.push({ label: 'Tell me about services', prompt: 'Tell me about your medical transport services' });
            }
            if (!responseActions.some((action) => action.action === 'transfer')) {
                responseActions.push({ label: 'Start a transfer', action: 'transfer' });
            }
            renderActions(responseActions);
            if (data.status) {
                history.push({ role: 'user', text: cleanText }, { role: 'assistant', text: data.message });
            }
        } catch (error) {
            pending.innerHTML = '<span class="ai-message__text">The assistant is temporarily unavailable. Please call or use WhatsApp to reach our team.</span>';
            pending.classList.remove('ai-message--pending');
            pending.classList.remove('ai-message--typing');
        }
        messages.scrollTop = messages.scrollHeight;
    };

    launcher.addEventListener('click', () => setOpen(panel.hidden));
    closeButton.addEventListener('click', () => setOpen(false));
    restartButton.addEventListener('click', resetConversation);
    document.querySelectorAll('[data-open-ai]').forEach((button) => {
        button.addEventListener('click', () => setOpen(true));
    });
    root.querySelector('[data-start-transfer]').addEventListener('click', startTransferFlow);
    root.querySelector('[data-show-enquiry]')?.addEventListener('click', () => showEnquiry(true));
    root.querySelector('[data-hide-enquiry]').addEventListener('click', () => showEnquiry(false));

    root.querySelectorAll('[data-prompt]').forEach((button) => {
        button.addEventListener('click', () => sendMessage(button.dataset.prompt));
    });

    chatForm.addEventListener('submit', (event) => {
        event.preventDefault();
        sendMessage(input.value);
    });

    input.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            chatForm.requestSubmit();
        }
    });

    input.addEventListener('input', () => {
        input.style.height = 'auto';
        input.style.height = `${Math.min(input.scrollHeight, 100)}px`;
    });

    if (root.dataset.autoOpen === 'true' && !window.sessionStorage.getItem('ashoka-ai-introduced')) {
        window.sessionStorage.setItem('ashoka-ai-introduced', 'true');
        window.setTimeout(() => setOpen(true), 700);
    }

    enquiryForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const submitButton = enquiryForm.querySelector('[type="submit"]');
        const values = Object.fromEntries(new FormData(enquiryForm).entries());
        submitButton.disabled = true;
        submitButton.textContent = 'Sending…';

        try {
            const response = await fetch(root.dataset.endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'lead', ...values, csrf_token: csrfToken }),
            });
            const data = await response.json();
            if (!data.status) throw new Error(data.message || 'Unable to send enquiry.');

            enquiryForm.reset();
            showEnquiry(false);
            addMessage(data.message, 'assistant');
        } catch (error) {
            window.alert(error.message || 'Unable to send enquiry. Please call our team.');
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Send enquiry <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>';
        }
    });
});
