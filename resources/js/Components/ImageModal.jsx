export default function ImageModal() {
    return (
        <div className="modal fade" id="imageModal" tabIndex="-1" aria-hidden="true">
            <div className="modal-dialog modal-xl modal-dialog-centered">
                <div className="modal-content bg-dark border-0 rounded-4 overflow-hidden">
                    <div className="modal-body p-0 position-relative">
                        <button type="button" className="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-2" data-bs-dismiss="modal"></button>
                        <img id="modalImage" src="" alt="" className="w-100" style={{ maxHeight: '82vh', objectFit: 'contain', background: '#07131f' }} />
                        <div className="position-absolute bottom-0 start-0 end-0 p-4" style={{ background: 'linear-gradient(transparent,rgba(0,0,0,.8))', color: '#fff' }}>
                            <div id="modalTitle" className="h4 serif mb-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
