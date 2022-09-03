const useLengthAwarePaginator = (data) => {
    return {
        items: data.data,

        current: data.meta.current_page,
        from: data.meta.from,
        last_page: data.meta.last_page,
        links: data.meta.links,
        path: data.meta.path,
        per_page: data.meta.per_page,
        to: data.meta.to,
        total: data.meta.total,

        firstUrl: data.links.first,
        lastUrl: data.links.last,
        nextUrl: data.links.next,
        prevUrl: data.links.prev,

        hasNextPage: data.links.first !== null,
        hasPrevPage: data.links.prev !== null,
    }
}

export {
    useLengthAwarePaginator,
};
