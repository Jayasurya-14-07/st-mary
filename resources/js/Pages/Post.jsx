import { Head } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpostHero from '../Components/SubpostHero';
import BlockRenderer from '../Components/BlockRenderer';

export default function Post({ post = null, flashNews = [] }) {
    if (!post) {
        return (
            <AppLayout flashNews={flashNews}>
                <Head title="Post Not Found - St. Mary's Convent School" />
                <SubpostHero title="Post Not Found" />
                <div className="container py-5 text-center">
                    <h3>Post Not Found</h3>
                    <p className="text-muted">The requested post could not be found.</p>
                </div>
            </AppLayout>
        );
    }

    const formattedDate = post.publish_date || post.created_at
        ? new Date(post.publish_date || post.created_at).toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        })
        : null;

    return (
        <AppLayout flashNews={flashNews}>
            <Head title={`${post.title || 'Post'} - St. Mary's Convent School`} />

            {/* Subpost Hero Header with Category Names */}
            <SubpostHero post={post} />

            {/* Post Content */}
            <section className="history-content py-5 subpage bg-white">
                <div className="container">
                    <div className="row">
                        <div className="col-12">
                            <h2 className="display-6 fw-bold text-navy mb-3">{post.title}</h2>

                            {formattedDate && (
                                <div className="news-meta-item text-muted mb-4 small d-flex align-items-center gap-2">
                                    <i className="fa-regular fa-calendar text-gold"></i>
                                    <span>{formattedDate}</span>
                                </div>
                            )}

                            {post.content && Array.isArray(post.content) ? (
                                <BlockRenderer blocks={post.content} />
                            ) : post.content ? (
                                <div 
                                    className="content-text tiptap-content"
                                    dangerouslySetInnerHTML={{ __html: post.content }}
                                />
                            ) : (
                                <p className="text-muted">No content available for this post.</p>
                            )}
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>
    );
}
