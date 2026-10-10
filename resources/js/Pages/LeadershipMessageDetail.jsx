import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';
import BlockRenderer from '../Components/BlockRenderer';

export default function LeadershipMessageDetail({ message = null }) {
    if (!message) {
        return (
            <AppLayout>
                <Head title="Message Not Found - St. Mary's Convent School" />
                <SubpageHero title="Message Not Found" />
                <div className="container py-5 text-center">
                    <h3>Message Not Found</h3>
                    <p className="text-muted">The requested leadership message could not be found.</p>
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout>
            <Head title={`${message.name} — ${message.position} Message`} />

            <SubpageHero 
                title={`${message.position} Message`} 
                breadcrumbs={[
                    { name: `${message.position} Message` }
                ]} 
            />

            <section className="section py-5 bg-white">
                <div className="container">
                    <div className="row justify-content-center">
                        <div className="col-lg-10">
                            {/* Author Header Card */}
                            <div className="message-card mb-5 border-0 shadow-sm bg-paper p-4 p-md-5 rounded-4">
                                <div className="row g-4 align-items-center">
                                    <div className="col-lg-4 text-center">
                                        <div className="message-photo-wrapper mx-auto">
                                            <img 
                                                src={message.feature_image || '/images/logo.png'} 
                                                alt={`${message.name} - ${message.position}`} 
                                                className="message-photo" 
                                            />
                                        </div>
                                        <h3 className="message-author-name mt-3 mb-1 text-navy">{message.name}</h3>
                                        <div className="badge bg-wine px-3 py-2 rounded-pill fw-semibold">{message.position}</div>
                                        {message.subtext && (
                                            <div className="text-muted small mt-2">{message.subtext}</div>
                                        )}
                                    </div>
                                    <div className="col-lg-8">
                                        <div className="message-body">
                                            <i className="fa-solid fa-quote-left quote-icon mb-3 text-gold fs-1"></i>
                                            {message.excerpt ? (
                                                <div 
                                                    className="message-text tiptap-content fs-5 lead text-dark opacity-90"
                                                    dangerouslySetInnerHTML={{ __html: message.excerpt }}
                                                />
                                            ) : null}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Full Detailed Content */}
                            {message.content && Array.isArray(message.content) && message.content.length > 0 ? (
                                <div className="full-content-wrapper">
                                    <BlockRenderer blocks={message.content} />
                                </div>
                            ) : message.content && typeof message.content === 'string' ? (
                                <div 
                                    className="content-text tiptap-content"
                                    dangerouslySetInnerHTML={{ __html: message.content }}
                                />
                            ) : null}

                            <div className="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
                                <Link href="/#messages" className="btn btn-outline-premium">
                                    <i className="fa-solid fa-arrow-left me-2"></i> Back to Leadership Messages
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>
    );
}
