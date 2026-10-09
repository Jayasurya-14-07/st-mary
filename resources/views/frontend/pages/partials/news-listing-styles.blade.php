<style>
    .listing-card {
        height: 100%;
        border: 1px solid #e7e7e7;
        background: #fff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
    }

    .listing-card-image {
        display: block;
        height: 210px;
        overflow: hidden;
        background: #f4f4f4;
    }

    .listing-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .3s ease;
    }

    .listing-card:hover .listing-card-image img {
        transform: scale(1.05);
    }

    .listing-card-body {
        padding: 18px;
    }

    .listing-card-body h3 {
        margin: 0 0 8px;
        font-size: 18px;
        line-height: 1.35;
        font-weight: 800;
    }

    .listing-card-body h3 a {
        color: #101010;
        text-decoration: none;
    }

    .listing-card-body h3 a:hover,
    .listing-read-more {
        color: #ef3656;
    }

    .listing-date {
        margin-bottom: 10px;
        color: #666;
        font-size: 13px;
    }

    .listing-card-body p {
        margin-bottom: 12px;
        color: #444;
        font-size: 14px;
        line-height: 1.6;
    }

    .listing-read-more {
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }
</style>
