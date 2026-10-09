import { Head } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';
import BlockRenderer from '../Components/BlockRenderer';

export default function Page({ page = null, breadcrumbs = [], flashNews = [] }) {
    if (!page) {
        return (
            <AppLayout flashNews={flashNews}>
                <Head title="Page Not Found - St. Mary's Convent School" />
                <SubpageHero title="Page Not Found" />
                <div className="container py-5 text-center">
                    <h3>Page Not Found</h3>
                    <p className="text-muted">The requested page could not be found.</p>
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout flashNews={flashNews}>
            <Head title={`${page.title || 'Page'} - St. Mary's Convent School`} />

            {/* Subpage Banner Header */}
            <SubpageHero page={page} breadcrumbs={breadcrumbs} />

            {/* Subpage Main Content from Filament DB Blocks */}
            <section className="bg-white subpage py-5">
                <div className="container py-3">
                    <div className="row">
                        <div className="col-12">
                            {page.content && Array.isArray(page.content) ? (
                                <BlockRenderer blocks={page.content} />
                            ) : page.content ? (
                                <div 
                                    className="content-text tiptap-content"
                                    dangerouslySetInnerHTML={{ __html: page.content }}
                                />
                            ) : (
                                <p className="text-muted">No content available for this page.</p>
                            )}
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>
    );
}
