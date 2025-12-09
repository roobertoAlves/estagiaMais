/**
 * ESTAGIA+ - JavaScript Principal
 * Funcionalidades gerais da aplicação
 */

// Inicializar quando DOM está pronto
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Inicializar AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out-quart',
            once: false,
            mirror: false
        });
    }

    // Inicializar event listeners
    setupEventListeners();
    
    // Inicializar tooltips customizados
    initializeTooltips();

    // Verificar se usuário tem temas salvos
    applyUserTheme();
}

/**
 * Configurar event listeners globais
 */
function setupEventListeners() {
    // Fechar modais ao clicar no background
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });

    // Smooth scroll para links âncora
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

    // Validação de formulários
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                return false;
            }
        });
    });
}

/**
 * Validar formulário antes de enviar
 */
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

    inputs.forEach(input => {
        const errorElement = input.parentElement.querySelector('.error-message');
        
        if (!input.value.trim()) {
            showError(input, 'Este campo é obrigatório');
            isValid = false;
        } else if (input.type === 'email' && !isValidEmail(input.value)) {
            showError(input, 'Email inválido');
            isValid = false;
        } else if (input.type === 'password' && input.value.length < 8) {
            showError(input, 'Senha muito curta');
            isValid = false;
        } else {
            clearError(input);
        }
    });

    return isValid;
}

/**
 * Validar email
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Mostrar erro no input
 */
function showError(input, message) {
    input.style.borderColor = 'var(--erro)';
    
    let errorElement = input.parentElement.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('span');
        errorElement.className = 'error-message';
        input.parentElement.appendChild(errorElement);
    }
    
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

/**
 * Limpar erro do input
 */
function clearError(input) {
    input.style.borderColor = '';
    
    const errorElement = input.parentElement.querySelector('.error-message');
    if (errorElement) {
        errorElement.style.display = 'none';
    }
}

/**
 * Inicializar tooltips customizados
 */
function initializeTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    
    tooltips.forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltipText = this.getAttribute('data-tooltip');
            const tooltip = document.createElement('div');
            
            tooltip.className = 'tooltip';
            tooltip.textContent = tooltipText;
            tooltip.style.cssText = `
                position: absolute;
                background-color: var(--azul);
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                font-size: 0.85rem;
                white-space: nowrap;
                z-index: 1000;
                pointer-events: none;
                animation: slideUp 0.3s ease;
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + 'px';
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';
            
            this.addEventListener('mouseleave', function() {
                tooltip.remove();
            });
        });
    });
}

/**
 * Aplicar tema customizado do usuário
 */
function applyUserTheme() {
    const savedTheme = localStorage.getItem('user_theme');
    
    if (savedTheme) {
        const theme = JSON.parse(savedTheme);
        document.documentElement.style.setProperty('--azul', theme.primary_color);
        document.documentElement.style.setProperty('--amarelo', theme.secondary_color);
    }
}

/**
 * Salvar tema customizado
 */
function saveTheme(primaryColor, secondaryColor) {
    const theme = {
        primary_color: primaryColor,
        secondary_color: secondaryColor
    };
    
    localStorage.setItem('user_theme', JSON.stringify(theme));
    applyUserTheme();
}

/**
 * Mostrar notificação toast
 */
function showToast(message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 16px 24px;
        background-color: ${getColorByType(type)};
        color: white;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        animation: slideUp 0.3s ease;
        max-width: 300px;
        word-break: break-word;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideDown 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

function getColorByType(type) {
    const colors = {
        'success': '#4CAF50',
        'error': '#F44336',
        'warning': '#FF9800',
        'info': '#2196F3'
    };
    return colors[type] || colors['info'];
}

/**
 * Copiar para clipboard
 */
function copyToClipboard(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    showToast('Copiado para clipboard!', 'success');
}

/**
 * Formatar data
 */
function formatDate(date, format = 'dd/mm/yyyy') {
    const d = new Date(date);
    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();
    
    return format
        .replace('dd', day)
        .replace('mm', month)
        .replace('yyyy', year);
}

/**
 * Debounce para otimizar performance
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle para limitar execução
 */
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/**
 * Animar contador numérico
 */
function animateCounter(element, target, duration = 2000) {
    const current = parseInt(element.textContent) || 0;
    const step = target / (duration / 16);
    let value = current;
    
    const interval = setInterval(() => {
        value += step;
        if (value >= target) {
            element.textContent = target;
            clearInterval(interval);
        } else {
            element.textContent = Math.floor(value);
        }
    }, 16);
}

/**
 * Lazy load para imagens
 */
function initializeLazyLoad() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.getAttribute('data-src');
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => observer.observe(img));
    } else {
        // Fallback para navegadores antigos
        images.forEach(img => {
            img.src = img.getAttribute('data-src');
            img.removeAttribute('data-src');
        });
    }
}

/**
 * Verificar conectividade
 */
function checkConnectivity() {
    const online = navigator.onLine;
    
    if (!online) {
        showToast('Sem conexão com a internet', 'warning');
    }
    
    return online;
}

// Monitorar mudanças de conectividade
window.addEventListener('online', () => {
    showToast('Conexão restaurada!', 'success');
});

window.addEventListener('offline', () => {
    showToast('Você perdeu a conexão com a internet', 'error');
});

/**
 * Função utilitária para fazer requisições AJAX
 */
function fetchAPI(url, options = {}) {
    const defaultOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };
    
    return fetch(url, { ...defaultOptions, ...options })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .catch(error => {
            console.error('Fetch error:', error);
            showToast('Erro na requisição', 'error');
            throw error;
        });
}

/**
 * Exportar dados para CSV
 */
function exportToCSV(filename, data) {
    const csv = convertToCSV(data);
    const link = document.createElement('a');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv));
    link.setAttribute('download', filename);
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function convertToCSV(data) {
    if (!data || data.length === 0) return '';
    
    const keys = Object.keys(data[0]);
    const csv = [keys.join(',')];
    
    data.forEach(row => {
        csv.push(keys.map(key => JSON.stringify(row[key])).join(','));
    });
    
    return csv.join('\n');
}

// Exportar funções globais
window.showToast = showToast;
window.copyToClipboard = copyToClipboard;
window.formatDate = formatDate;
window.animateCounter = animateCounter;
window.fetchAPI = fetchAPI;
window.exportToCSV = exportToCSV;
window.saveTheme = saveTheme;
window.checkConnectivity = checkConnectivity;
