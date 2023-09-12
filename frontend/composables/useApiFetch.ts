import type { UseFetchOptions } from 'nuxt/app'
import { defu } from 'defu'
export function  useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {
  let headers:any = {
    accept: 'application/json',
  }

  const token = useCookie('XSRF-TOKEN');

  if(token.value) {
    headers['X-XSRF-TOKEN'] = token.value as string;
  }

  if(process.server) {
    headers = {
      ...headers,
      ...useRequestHeaders(['referer','cookie'])
    }
  }

  return useFetch('http://bitter.local/api' + path,{
    credentials: 'include',
    watch: false,
    ...options,
    headers: {
      ...headers,
      ...options?.headers
    }
  });

}
