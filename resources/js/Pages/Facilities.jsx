import { useEffect } from 'react';
import { Head } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';
import BlockRenderer from '../Components/BlockRenderer';

export default function Facilities({ facilities = [], facilitiesSection = null, flashNews = [] }) {
    useEffect(() => {
        // Handle hash scrolling (e.g. /facilities#computer-lab)
        if (window.location.hash) {
            const targetId = window.location.hash.substring(1);
            const element = document.getElementById(targetId);
            if (element) {
                setTimeout(() => {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 200);
            }
        }
    }, []);

    return (
        <AppLayout flashNews={flashNews}>
            <Head title="Facilities — St. Mary's Convent School" />

            <SubpageHero
                title="Facilities"
                breadcrumbs={[{ name: 'Facilities', url: '/facilities' }]}
            />

            <section className="py-4 py-md-5 bg-light-subtle">
                <div className="container py-2">
                    {/* Facilities List Grid */}
                    {facilities && facilities.length > 0 ? (
                        <div className="row g-4">
                            {facilities.map((facility, index) => {
                                const isArrayContent = Array.isArray(facility.content);
                                return (
                                    <div
                                        key={facility.id || index}
                                        id={facility.slug}
                                        className="col-12 mb-4 scroll-margin-top"
                                    >
                                        <div className="card border-0 shadow-sm rounded-4 overflow-hidden bg-white pt-4 pb-2 px-3 px-md-4 text-center">
                                            <h2 className="section-title text-navy fs-2 fw-bold mt-1 mb-3 text-center">
                                                {facility.title}
                                            </h2>

                                            {facility.feature_image && (
                                                <div className="mb-3 rounded-3 overflow-hidden mx-auto" style={{ maxHeight: '380px', maxWidth: '800px' }}>
                                                    <img
                                                        src={facility.feature_image}
                                                        alt={facility.title}
                                                        className="w-100 h-100 object-fit-cover rounded-3 shadow-sm"
                                                    />
                                                </div>
                                            )}

                                            <div className="facility-body text-center mb-1">
                                                {isArrayContent ? (
                                                    <BlockRenderer blocks={facility.content} textCenter={true} />
                                                ) : facility.content ? (
                                                    <div
                                                        className="tiptap-content text-dark fs-6 text-center mb-0"
                                                        style={{ lineHeight: '1.75' }}
                                                        dangerouslySetInnerHTML={{ __html: facility.content }}
                                                    />
                                                ) : null}
                                            </div>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    ) : (
                        <div className="text-center py-5 bg-white rounded-4 shadow-sm my-3">
                            <i className="fa-solid fa-building-circle-exclamation text-navy mb-3 opacity-50" style={{ fontSize: '56px' }}></i>
                            <h3 className="fw-bold text-navy mb-2">No Facilities Found</h3>
                            <p className="text-muted mb-0">We haven't added any facility records yet. Please check back later.</p>
                        </div>
                    )}
                </div>
            </section>
        </AppLayout>
    );
}
